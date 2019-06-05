<?php

namespace App\Http\Controllers;

use App\SurveyAnswers;
use App\SurveyQuestions;
use App\SurveyResults;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function index()
    {
        $response = array();

        $response['questions'] = SurveyQuestions::all();
        $response['results'] = SurveyResults::all();

        return view('pages.admin.surveyResults')->with($response);
    }

    public function create(){
        $response = array();

        if(Auth::check()){
            if(Auth::user()->survey == 1){
                $response['messageType'] = "warning";
                $response['messageHeading'] = "Not available!";
                $response['message'] = "You have already completed the survey and you can't complete the survey more than once.";

                return view('layouts.app')->with($response);
            }
            $response['survey'] = SurveyAnswers::all()->groupBy('idQuestion');

            return view('pages.survey')->with($response);
        }
        else{
            $response['messageType'] = "warning";
            $response['messageHeading'] = "Not available!";
            $response['message'] = "You must be logged in to take this survey.";

            return view('layouts.app')->with($response);
        }
    }

    public function submit(Request $request)
    {
        $request->validate([
            'question1' => 'required|exists:surveyanswers,idAnswer',
            'question2' => 'required|exists:surveyanswers,idAnswer'
        ]);

        $idAnswer1 = $request->input('question1');
        $idAnswer2 = $request->input('question2');
        $comment = $request->input('comment');

        $surveyResult = new SurveyResults();

        $surveyResult->idUser = Auth::user()->idUser;
        $surveyResult->idAnswer1 = $idAnswer1;
        $surveyResult->idAnswer2 = $idAnswer2;
        $surveyResult->comment = $comment;

        $surveyResult->save();

        $user = Auth::user();

        $user->survey=1;

        $user->save();

        http_response_code(200);

        $response = array();
        $response['messageType']="success";
        $response['messageHeading']="Well Done!";
        $response['message']="You have successfully completed the survey.";

        return view('include.message')->with($response);
    }
}
