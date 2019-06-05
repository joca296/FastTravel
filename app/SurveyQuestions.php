<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyQuestions extends Model
{
    protected $table = "surveyquestions";
    protected $primaryKey = "idQuestion";
    public $timestamps = false;
}
