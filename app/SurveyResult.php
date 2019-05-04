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
        return SurveyResult::select(DB::raw('JSON_EXTRACT(json, "$.'. $question .'") country, count(JSON_EXTRACT(json, "$.'. $question .'")) cnt'))->groupBy('country');
    }
}
