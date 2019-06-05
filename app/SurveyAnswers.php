<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyAnswers extends Model
{
    protected $table = "surveyanswers";
    protected $primaryKey = "idAnswer";
    public $timestamps = false;

    public function question(){
        return $this->hasOne('App\SurveyQuestions','idQuestion','idQuestion');
    }
}
