<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Favorite;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\PostDetailResource;
use App\Http\Resources\PostResource;
use App\Post;
use App\PostView;
use App\Rating;
use Illuminate\Http\Request;

/**
 * This controller handle all api request to the information related to the post.
 * Class PostApiController
 * @package App\Http\Controllers
 *
 */
class PostApiController extends Controller
{
    /**
     * Display a listing of the post page on search condition.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //If the status is not provide then search global post for home page without the post created by current user
        if (!isset($request->status)) {
            return PostResource::collection(searchPost(null, null, $request->search, null, 10, ['author'], auth()->guard('api')->user()->id));
        } else if ($request->status == "FAVORITE") {
            //If the status is favorite, then search the favorite post of current user
            return PostResource::collection(searchPost(null, null, $request->search, auth()->guard('api')->user()->id, 10, ['author'])->appends(['status' => $request->status]));
        } else {
            //Otherwise, search the post belong to user based on status : DRAFT, CLOSED, PENDING, PUBLIC
            return PostResource::collection(searchPost(auth()->guard('api')->user()->id, $request->status, $request->search, null, 10, ['author'])->appends(['status' => $request->status]));
        }
    }

    /**
     * Return all information of a post based on id
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return Post::with('images')->find($id);
    }

    /**
     * Return all comments of a post
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function comments($id)
    {
        return CommentResource::collection(Post::find($id)->comments()->orderBy('created_at', 'desc')->with(['author', 'rating'])->paginate(5));
    }

    /**
     * Return all image url of a post
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function images($id)
    {
        return ImageResource::collection(Post::find($id)->images);
    }

    /**
     * Return all detail attributes of a post
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
        return PostDetailResource::collection(Post::find($id)->details);
    }


    /**
     * Add one view to a specific post when user view the detail of a post.
     *
     * @param $id
     * @return void
     */
    public function addView($id)
    {

        //The the post
        $post = Post::find($id);

        if ($post == null) {
            //If it is not exist then return error
            $result = (object)[
                'status' => 'ERROR',
                'msg' => 'The post is not exist',
            ];
            return response()->json($result);
        } else {
            //Add one view for this post to database
            $postView = new PostView([
                'user_id' => auth()->guard('api')->user()->id,
                'post_id' => $id
            ]);

            $postView->save();

            //Update total view of this post
            $totalView = $post->total_views;
            $post->total_views = $totalView + 1;
            $post->save();

            //Return success result to client
            $result = (object)[
                'status' => 'SUCCESS'
            ];

            return response()->json($result);
        }
    }

    /**
     * Add comment to a specific post including user rating for the post.
     *
     * @param $id
     * @param Request $request
     * @return void
     */
    public function addComment($id, Request $request)
    {

        //Find the post
        $post = Post::find($id);

        if ($post == null) {
            //If it is not exist then return error
            $result = (object)[
                'status' => 'ERROR',
                'msg' => 'The post is not exist',
            ];
            return response()->json($result);
        } else {

            //Validate the input
            $validatedData = $request->validate([
                'comment' => 'required',
                'rating' => 'nullable|numeric',
            ]);
            if (isset($validatedData->errors)) {
                //If validation fail then return the error information to client
                return $validatedData;
            }


            //Insert a post comment
            $postComment = new Comment([
                'user_id' => auth()->guard('api')->user()->id,
                'post_id' => $id,
                'comment' => $request->comment
            ]);
            $postComment->save();

            //Update total comment of this post
            $post->total_comments = $post->comments()->count();

            if (isset($request->rating)) {
                //Insert a post rating
                $postRating = new Rating([
                    'user_id' => auth()->guard('api')->user()->id,
                    'post_id' => $id,
                    'rating' => $request->rating
                ]);
                $postRating->save();

                //calculate the post rating average
                $post->avg_rating = $post->ratings()->avg('rating');
                //Calculate the total rating on this post
                $post->total_ratings = $post->ratings()->count();
            }

            //Update the post information
            $post->save();

            //Return success result to client
            $result = (object)[
                'status' => 'SUCCESS'
            ];

            return response()->json($result);
        }
    }

    /**
     * This controller method allow user to add or remote favorite on a Post
     *
     * @param $id : The post id
     * @return void
     */
    public function changeFavorite($id)
    {

        //Find the post
        $post = Post::find($id);

        if ($post == null) {
            //If it is not exist then return error
            $result = (object)[
                'status' => 'ERROR',
                'msg' => 'The post is not exist',
            ];
            return response()->json($result);
        } else {
            $favorites = Favorite::query()->where('post_id', $id)->where('user_id', auth()->guard('api')->user()->id)->get();


            if (count($favorites) > 0) {
                $favorite = $favorites[0];
                $favorite->delete();
            } else {
                $favorite = new Favorite([
                    'post_id' => $id,
                    'user_id' => auth()->guard('api')->user()->id
                ]);
                $favorite->save();
            }

            //Return success result to client
            $result = (object)[
                'status' => 'SUCCESS'
            ];

            return response()->json($result);
        }
    }

    /**
     * Update the post status.
     *
     * @param  $id post id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updatePostStatus($id, Request $request)
    {
        //Find the post
        $post = Post::find($id);

        if ($post == null) {
            //If it is not exist then return error
            $result = (object)[
                'status' => 'ERROR',
                'msg' => 'The post is not exist',
            ];
            return response()->json($result);
        }

        //Validate the input
        $validatedData = $request->validate([
            'status' => 'required|in:PUBLISHED,CLOSED,PENDING,DRAFT',
        ]);
        if (isset($validatedData->errors)) {
            //If validation fail then return the error information to client
            return $validatedData;
        }

        $post->status = $request->status;
        $post->save();

        $result = (object)[
            'status' => 'SUCCESS',
            'post_status' => $request->status
        ];

        return response()->json($result);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
