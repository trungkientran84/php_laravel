<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * This controller handle requests to post information of current user.
 *
 * Class MyPostController
 * @package App\Http\Controllers\User
 *
 */
class MyPostController extends Controller
{
    /**
     * This is make sure the the request only being served if user has login
     * MyPostController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Return the published post of current user
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function publicPost(Request $request)
    {
        //Call helper method to search the required post
        $posts = searchPost(Auth::id(), null, $request->search);
        $title = "Published Post";
        return view('user.post-list', compact('posts', 'title'));
    }

    /**
     * Return the pending post of current user
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pendingPost(Request $request)
    {
        //Call helper method to search the required post
        $posts = searchPost(Auth::id(), 'PENDING', $request->search);
        $title = "Pending Post";
        return view('user.post-list', compact('posts', 'title'));
    }

    /**
     * Return the closed posts of current user
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function closedPost(Request $request)
    {
        //Call helper method to search the required post
        $posts = searchPost(Auth::id(), 'CLOSED', $request->search);
        $title = "Private Post";
        return view('user.post-list', compact('posts', 'title'));
    }

    /**
     * Return the draft posts of current user
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function draftPost(Request $request)
    {
        //Call helper method to search the required post
        $posts = searchPost(Auth::id(), 'DRAFT', $request->search);
        $title = "Draft Post";
        return view('user.post-list', compact('posts', 'title'));
    }

    /**
     * Return the favorite posts of current user
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function favoritePost(Request $request)
    {
        //Call helper method to search the required post
        $posts = searchPost(null, null, $request->search, Auth::id());
        $title = "Favorite Post";
        return view('user.post-list', compact('posts', 'title'));
    }
}
