<?php

namespace App\Http\Controllers;

use App\Charts\AgesChart;
use App\Charts\CountriesChart;
use App\Charts\GendersChart;
use App\SurveyResult;

class AdminController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function results()
    {
        $femalesCount = SurveyResult::getGendersCount("question12", "item1");
        $malesCount = SurveyResult::getGendersCount("question12", "item2");
        $othersCount = SurveyResult::getGendersCount("question12", "item3");

        $gendersChart = new GendersChart();
        $gendersChart->displayAxes(false);
        $gendersChart->labels(["Female", "Male", "Other"]);
        $dataset = $gendersChart->dataset('data', 'pie', [$femalesCount, $malesCount, $othersCount]);
        $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838']));
        $dataset->color(collect(['#7d5fff','#32ff7e', '#ff4d4d']));

        $lt17 = SurveyResult::getAgesCount('question13', 'item1');
        $between18And20 = SurveyResult::getAgesCount('question13', 'item2');
        $between21And29 = SurveyResult::getAgesCount('question13', 'item3');
        $between30And39 = SurveyResult::getAgesCount('question13', 'item4');
        $between40And49 = SurveyResult::getAgesCount('question13', 'item5');
        $between50And59 = SurveyResult::getAgesCount('question13', 'item6');
        $gt60 = SurveyResult::getAgesCount('question13', 'item7');

        $agesChart = new AgesChart();
        $agesChart->labels(["<18", "18-20", "21-29", "30-39", "40-49", "50-59", ">=60"]);
        $agesChart->dataset('data', 'bar', [
            $lt17, $between18And20, $between21And29, $between30And39, $between40And49, $between50And59, $gt60
        ]);

//        dd([$femalesCount, $malesCount, $othersCount]);
//        dd([$lt17, $between18And20, $between21And29, $between30And39, $between40And49, $between50And59, $gt60]);
//        dd($gendersChart, $agesChart);

        return view('results', compact([
            'gendersChart',
            'agesChart',
        ]));
    }
}
