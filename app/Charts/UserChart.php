<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

/**
 * This class supports creating chart
 * Class UserChart
 * @package App\Charts
 */
class UserChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Prepare monthly data for monthly chart type which the data span over 12 months
     * @param $data
     * @return array
     */
    public static function monthlyDataPrepare($data){
        $result = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        foreach ($data as $item){
            $result[$item->month-1] = $item->data;
        }

        return $result;
    }

    /**
     * Covert linear data to percentage data of rating chart
     * @param $data
     * @return array
     */
    public static function convertRatingToChart($data){
        $result = Array();
        $rating = [];
        $count = [];
        foreach ($data as $item){
            array_push($rating, $item->rating . " Star");
            array_push($count, $item->data);
        }

        return ['label' => $rating, 'data' => $count ];

    }

}
