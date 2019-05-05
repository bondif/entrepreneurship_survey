<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SurveyResult extends Model
{
    //

    public static function getGendersCount($question, $gender)
    {
        return SurveyResult::select(['JSON_EXTRACT(json, "$.'. $question .'")'])->whereRaw('JSON_EXTRACT(json, "$.' . $question . '") = "' . $gender . '"')->count();
    }

    public static function getAgesCount($question, $ageInterval)
    {
        return SurveyResult::select(['JSON_EXTRACT(json, "$.'. $question .'")'])->whereRaw('JSON_EXTRACT(json, "$.' . $question . '") = "' . $ageInterval . '"')->count();
    }

    public static function getCountriesCount($question)
    {
        return SurveyResult::select(DB::raw('JSON_EXTRACT(json, "$.'. $question .'") country, count(JSON_EXTRACT(json, "$.'. $question .'")) cnt'))
            ->groupBy('country')
            ->get();
    }

    public static function getHasMadeOnlinePurchase($question, $onlinePurchase)
    {
        return SurveyResult::select(DB::raw('JSON_EXTRACT(json, "$.'. $question .'")'))
            ->whereRaw('json_extract(json, "$.' . $question . '") = "' . $onlinePurchase . '"')
            ->count();
    }

    public static function getMarketingStrategy($question, $item)
    {
        return SurveyResult::select(DB::raw('JSON_EXTRACT(json, "$.'. $question .'")'))
            ->whereRaw('locate("' . $item . '", JSON_EXTRACT(json, "$.' . $question . '")) > 0')
            ->count();
    }

    public static function getMarkets($question, $item)
    {
        return SurveyResult::select(DB::raw('JSON_EXTRACT(json, "$.'. $question .'")'))
            ->whereRaw('locate("' . $item . '", JSON_EXTRACT(json, "$.' . $question . '")) > 0')
            ->count();
    }

    public static function getBestProducts($question, $item)
    {
        return SurveyResult::select(DB::raw('JSON_EXTRACT(json, "$.'. $question .'")'))
            ->whereRaw('locate("' . $item . '", JSON_EXTRACT(json, "$.' . $question . '")) > 0')
            ->count();
    }

    public static function getAverageBudgets($question, $item)
    {
        return SurveyResult::select(DB::raw('JSON_EXTRACT(json, "$.'. $question .'")'))
            ->whereRaw('locate("' . $item . '", JSON_EXTRACT(json, "$.' . $question . '")) > 0')
            ->count();
    }

    public static function getBestProductAspects($question, $item)
    {
        return SurveyResult::select(DB::raw('JSON_EXTRACT(json, "$.'. $question .'")'))
            ->whereRaw('locate("' . $item . '", JSON_EXTRACT(json, "$.' . $question . '")) > 0')
            ->count();
    }

    public static function getWantCustomProduct($question, $item)
    {
        return SurveyResult::select(DB::raw('JSON_EXTRACT(json, "$.'. $question .'")'))
            ->whereRaw('locate("' . $item . '", JSON_EXTRACT(json, "$.' . $question . '")) > 0')
            ->count();
    }
}
