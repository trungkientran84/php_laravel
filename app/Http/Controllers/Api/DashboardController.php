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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * This controller handle all api request to the information related to the post.
 * Class PostApiController
 * @package App\Http\Controllers
 *
 */
class DashboardController extends Controller
{
    /**
     * List all year of current user post statistic
     *
     * @return \Illuminate\Http\Response
     */
    public function historyYears()
    {

        $result = (object)[
            'years' => getDashboardHistoryYears(auth()->guard('api')->user()->id)
        ];

        return response()->json($result);
    }

    /**
     * Get summary comments, rating, views of all post in provided year of current user
     *
     * @param $year
     * @return \Illuminate\Http\Response
     */
    public function summary($year)
    {

        //Get current user id
        $userId = auth()->guard('api')->user()->id;

        //Call helper function to get statistic and construct json object
        $result = (object)[
            'posts' => getTotalPosts($userId, $year),
            'views' => getTotalViews($userId, $year),
            'comments' => getTotalComments($userId, $year),
            'ratings' => getTotalRatings($userId, $year)
        ];

        return response()->json($result);
    }

    /**
     * Get monthly statistic of posts in provided year of current user
     *
     * @param $year
     * @return \Illuminate\Http\Response
     */
    public function monthlyStatistic($year)
    {

        //Get current user id
        $userId = auth()->guard('api')->user()->id;

        //Call helper function to get statistic and construct json object
        $result = (object)[
            'posts' => getPostMonthlyStatistic($userId, $year),
            'views' => getViewsMonthlyStatistic($userId, $year),
            'ratings' => getRatingMonthlyStatistic($userId, $year),
            'comments' => getCommentMonthlyStatistic($userId, $year),
        ];

        return response()->json($result);
    }

    /**
     * Get rating statistic of all posts in provided year of current user
     *
     * @param $year
     * @return \Illuminate\Http\Response
     */
    public function ratingStatistic($year)
    {

        //Get current user id
        $userId = auth()->guard('api')->user()->id;

        //Call helper function to get statistic and construct json object
        $result = (object)[
            'statistic' => getRatingStatistic($userId, $year),
        ];

        return response()->json($result);
    }
}
