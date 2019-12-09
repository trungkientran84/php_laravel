<?php


use App\Charts\UserChart;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (!function_exists('frontSiteMenu')) {
    /**
     * This helper function is used for generate the sidebar menu dynamically.
     * @param $menuName
     * @param null $type
     * @param array $options
     * @return string
     */
    function frontSiteMenu($menuName, $type = null, array $options = [])
    {
        return \App\Menu::display($menuName, $type, $options);
    }
}

if (!function_exists('searchPost')) {
    /**
     * This helper function is used for searching post page on parameter
     * @param $userId : search posts created by this user
     * @param $status : The status of post including PENDING, CLOSED, PUBLIC, DRAFT
     * @param $search : Searching keyword if provided
     * @param null $favoriteUserId : indicate searching favorite post of a user
     * @param int $pagination : Number of item per page. Default is 15
     * @param array $relationship : Include relationship data in search result
     * @param $notIncludeAuthorId : exclude the post created by this use
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    function searchPost($userId, $status, $search, $favoriteUserId = null, $pagination = 15, $relationship = [], $notIncludeAuthorId = null)
    {

        $post = \App\Post::with($relationship) // Include the relationship data in search result. Ex> Author data
        //If $favoriteUserId that mean it is required to search the favorite post of user
        ->when($favoriteUserId,
            function ($query, $favoriteUserId) {
                return $query->whereIn('id', function ($query) use ($favoriteUserId) {
                    return $query->select('post_id')
                        ->from(with(new \App\Favorite())->getTable())
                        ->where('user_id', $favoriteUserId);
                });
            })
            //Search post a a specific user
            ->when($userId, function ($query, $userId) {
                return $query->where('author_id', $userId);
            })
            //Search post a a specific user
            ->when($notIncludeAuthorId != null, function ($query, $notIncludeAuthorId) {
                return $query->where('author_id', '!=', $notIncludeAuthorId);
            })
            ->when($status,
                // If $status is provided search by the filter by status
                function ($query, $status) {
                    return $query->where('status', $status);
                },
                // Otherwise, only return the published post
                function ($query) {
                    return $query->where('status', 'PUBLISHED');
                })
            ->when($search,
                //If $search is provided then search the key word on title and body of the post
                function ($query, $search) {
                    return $query->where(function ($query) use ($search) {
                        return $query->where('title', 'like', '%' . $search . '%')
                            ->orWhere('body', 'like', '%' . $search . '%');
                    }, $search);
                });


        return $post->paginate($pagination)->appends(['search' => $search]);
    }
}

if (!function_exists('getDashboardHistoryYears')) {
    /**
     * This helper function is used for getting history years of provided users
     *
     * @param $userId
     * @return Array
     */
    function getDashboardHistoryYears($userId){
        $historyYear= DB::table('posts')
            ->where('author_id', $userId, true)
            ->select(DB::raw('YEAR(created_at) year'))
            ->distinct()
            ->get();

        return $historyYear;
    }
}

if (!function_exists('getTotalPosts')) {
    /**
     * This helper function is used for getting total posts of provided users in provided year
     *
     * @param $userId
     * @param $year
     * @return Array
     */
    function getTotalPosts($userId, $year){
        return  $totalPosts = Post::where('author_id', $userId, true )
            ->where(DB::raw('YEAR(created_at)'), $year)->count();
    }
}

if (!function_exists('getTotalViews')) {
    /**
     * This helper function is used for getting total view on posts of provided users in provided year
     *
     * @param $userId
     * @param $year
     * @return Array
     */
    function getTotalViews($userId, $year){
        return  $totalViews = DB::table('posts')
            ->join('post_views', 'post_views.post_id', '=', 'posts.id')
            ->where('posts.author_id', $userId, true)
            ->whereYear('post_views.created_at', $year)
            ->select('post_views.id')
            ->count();;
    }
}

if (!function_exists('getTotalRatings')) {
    /**
     * This helper function is used for getting total comments on posts of provided users in provided year
     *
     * @param $userId
     * @param $year
     * @return Array
     */
    function getTotalRatings($userId, $year){
        return  DB::table('posts')
            ->join('ratings', 'ratings.post_id', '=', 'posts.id')
            ->where('posts.author_id', $userId, true)
            ->whereYear('ratings.created_at', $year)
            ->select('ratings.id')
            ->count();
    }
}

if (!function_exists('getTotalComments')) {
    /**
     * This helper function is used for getting total comments on posts of provided users in provided year
     *
     * @param $userId
     * @param $year
     * @return Array
     */
    function getTotalComments($userId, $year){
        return  DB::table('posts')
            ->join('comments', 'comments.post_id', '=', 'posts.id')
            ->where('posts.author_id', $userId, true)
            ->whereYear('comments.created_at', $year)
            ->select('comments.id')
            ->count();
    }
}


if (!function_exists('getPostMonthlyStatistic')) {
    /**
     * This helper function is used for getting monthly statistic of posts of provided users in provided year
     *
     * @param $userId
     * @param $year
     * @return Array
     */
    function getPostMonthlyStatistic($userId, $year){
        return  DB::table('posts')
            ->where('author_id', $userId, true)
            ->whereYear('created_at', $year)
            ->select(DB::raw('count(id) as `data`'),  DB::raw( 'MONTH(created_at) month'))
            ->groupby('month')
            ->orderBy('month')
            ->get();
    }
}

if (!function_exists('getViewsMonthlyStatistic')) {
    /**
     * This helper function is used for getting monthly statistic of views on posts of provided users in provided year
     *
     * @param $userId
     * @param $year
     * @return Array
     */
    function getViewsMonthlyStatistic($userId, $year){
        return  DB::table('posts')
            ->join('post_views', 'post_views.post_id', '=', 'posts.id')
            ->where('posts.author_id', $userId, true)
            ->whereYear('post_views.created_at', $year)
            ->select(DB::raw('count(post_views.id) as `data`'),  DB::raw( 'MONTH(post_views.created_at) month'))
            ->groupby('month')
            ->orderBy('month')
            ->get();
    }
}

if (!function_exists('getCommentMonthlyStatistic')) {
    /**
     * This helper function is used for getting monthly statistic of comments on posts  of provided users in provided year
     *
     * @param $userId
     * @param $year
     * @return Array
     */
    function getCommentMonthlyStatistic($userId, $year){
        return DB::table('posts')
            ->join('comments', 'comments.post_id', '=', 'posts.id')
            ->where('posts.author_id', $userId, true)
            ->whereYear('comments.created_at', $year)
            ->select(DB::raw('count(comments.id) as `data`'),  DB::raw( 'MONTH(comments.created_at) month'))
            ->groupby('month')
            ->orderBy('month')
            ->get();

    }
}

if (!function_exists('getRatingMonthlyStatistic')) {
    /**
     * This helper function is used for getting monthly statistic of ratings on posts  of provided users in provided year
     *
     * @param $userId
     * @param $year
     * @return Array
     */
    function getRatingMonthlyStatistic($userId, $year){
        return  DB::table('posts')
            ->join('ratings', 'ratings.post_id', '=', 'posts.id')
            ->where('posts.author_id', $userId, true)
            ->whereYear('ratings.created_at', $year)
            ->select(DB::raw('count(ratings.id) as `data`'),  DB::raw( 'MONTH(ratings.created_at) month'))
            ->groupby('month')
            ->orderBy('month')
            ->get();;
    }
}

if (!function_exists('getRatingStatistic')) {
    /**
     * This helper function is used for getting statistic of ratings on all posts  of provided users in provided year
     *
     * @param $userId
     * @param $year
     * @return Array
     */
    function getRatingStatistic($userId, $year){
        return  DB::table('posts')
            ->join('ratings', 'ratings.post_id', '=', 'posts.id')
            ->where('posts.author_id', $userId, true)
            ->whereYear('ratings.created_at', $year)
            ->select(DB::raw('count(ratings.id) as `data`'),  'ratings.rating')
            ->groupby('ratings.rating')
            ->orderBy('ratings.rating')
            ->get();
    }
}

if (!function_exists('prepareMonthlyPostChart')) {
    /**
     * This helper function is used for getting Monthly Post chart
     *
     * @param $userId
     * @param $year
     * @return UserChart
     */
    function prepareMonthlyPostChart($userId, $year){
        //get statistic data
        $monthlyPost = getPostMonthlyStatistic($userId, $year);

        //Create chart
        $monthly_post = new UserChart();
        $monthly_post->title('Monthly Post');
        $monthly_post->labels(["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"]);
        $monthly_post->dataset('Posts', 'bar', UserChart::monthlyDataPrepare($monthlyPost))->backgroundColor("rgba(105, 0, 132, 0.2)")->color('rgba(200, 99, 132, 0.7)');

        return $monthly_post;
    }
}

if (!function_exists('prepareMonthlyStatisticChart')) {
    /**
     * This helper function is used for preparing Monthly Statistic chart for comments, rating, views
     *
     * @param $userId
     * @param $year
     * @return UserChart
     */
    function prepareMonthlyStatisticChart($userId, $year){

        //getting monthly view statistic data
        $monthlyViews= getViewsMonthlyStatistic(Auth::id(), $year);

        //getting monthly rating statistic data
        $monthlyRatings= getRatingMonthlyStatistic(Auth::id(), $year);

        //getting monthly comment statistic data
        $monthlyComments= getCommentMonthlyStatistic(Auth::id(), $year);

        //prepare the chart
        $monthly_interactive_chart = new UserChart();
        $monthly_interactive_chart->title('Monthly Interactive Statistic');

        $monthly_interactive_chart->labels(["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"]);
        $monthly_interactive_chart->dataset('Views', 'line', UserChart::monthlyDataPrepare($monthlyViews))->backgroundColor("rgba(105, 0, 132, 0.2)")->color('rgba(200, 99, 132, 0.7)');
        $monthly_interactive_chart->dataset('Ratings', 'line', UserChart::monthlyDataPrepare($monthlyRatings))->backgroundColor("rgba(0, 137, 132, 0.2)")->color('rgba(0, 10, 130, 0.7)');
        $monthly_interactive_chart->dataset('Comments', 'line', UserChart::monthlyDataPrepare($monthlyComments))->backgroundColor("rgba(255, 159, 64, 0.2)")->color('rgba(255, 159, 64, 1)');

        return $monthly_interactive_chart;
    }
}

if (!function_exists('prepareRatingSummaryChart')) {
    /**
     * This helper function is used for preparing rating summary chart on all post of provided user in provided year
     *
     * @param $userId
     * @param $year
     * @return UserChart
     */
    function prepareRatingSummaryChart($userId, $year){

        //Prepare data
        $ratingSummary= getRatingStatistic(Auth::id(), $year);
        $ratingChartData = UserChart::convertRatingToChart($ratingSummary);

        //Prepare chart
        $rating_chart = new UserChart();
        $rating_chart->title('Rating Summary');
        $rating_chart->labels($ratingChartData['label']);
        $rating_chart->dataset('Ratings', 'bar', $ratingChartData['data'])->backgroundColor("rgba(105, 0, 132, 0.2)")->color('rgba(200, 99, 132, 0.7)');

        return $rating_chart;
    }
}




