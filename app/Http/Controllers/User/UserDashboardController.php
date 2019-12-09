<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

/**
 * This controller handles the request for current user's dashboard
 * Class UserDashboardController
 * @package App\Http\Controllers\User
 */
class UserDashboardController extends Controller
{
    /**
     * Protect this controller method with auth middleware
     * Only login user can access
     *
     * UserDashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Getting all data and charts for user dashboard
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //Get the current year.
        //If the request does not provide the specific year then get statistic for current year
        //Otherwise, get statistic on the provided year
        $year = date("Y");
        if(isset($request->year)){
            $year =$request->year;
        };

        // Getting history year
        $historyYear= getDashboardHistoryYears(Auth::id());

        //Getting total post
        $totalPosts = getTotalPosts(Auth::id(), $year);

        //Getting total views
        $totalViews = getTotalViews(Auth::id(), $year);

        //Getting total ratings
        $totalRatings = getTotalRatings(Auth::id(), $year);

        //Getting total comments
        $totalComments = getTotalComments(Auth::id(), $year);

        //Prepare month post chart
        $monthly_post = prepareMonthlyPostChart(Auth::id(), $year);

        //Prepare month statistic chart for comment post, ratings
        $monthly_interactive_chart = prepareMonthlyStatisticChart(Auth::id(), $year);

        //Prepare rating summary chart
        $rating_chart = prepareRatingSummaryChart(Auth::id(), $year);

        return view('user.dashboard',compact('year','historyYear', 'totalPosts', 'totalViews', 'totalComments','totalRatings',  'monthly_interactive_chart', 'monthly_post', 'rating_chart'));
    }
}
