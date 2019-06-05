<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyResults extends Model
{
    protected $table = "surveyresults";
    protected $primaryKey = "idResult";
    public $timestamps = false;

    public function user(){
        return $this->hasOne('App\User','idUser','idUser');
    }

    public function answer1(){
        return $this->hasOne('App\SurveyAnswers','idAnswer','idAnswer1');
    }

    public function answer2(){
        return $this->hasOne('App\SurveyAnswers','idAnswer','idAnswer2');
    }
}
