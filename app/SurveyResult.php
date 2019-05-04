<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
