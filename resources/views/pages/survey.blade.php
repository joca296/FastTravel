@extends('layouts.app')

@section('title','Survey')
@section('content')
    <div class="row content" id="surveyDiv">
        <div class="col-invisible col-lg-3"></div>
        <div class="col-12 col-lg-6">
            <form action="{{url('/')}}/survey" method="post" id="survey">
                @csrf
                @foreach($survey as $question)
                    <div class="form-group">
                        <label for="question{{$question->first()->question->idQuestion}}">{{$question->first()->question->question}}</label>
                        <select class="custom-select mr-2" name="question{{$question->first()->question->idQuestion}}" id="question{{$question->first()->question->idQuestion}}">
                            <option value="">Select...</option>
                            @foreach($question as $answer)
                                <option value="{{$answer->idAnswer}}">{{$answer->answer}}</option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
                <div class="form-group">
                    <label for="taComment">Comment: (optional)</label>
                    <textarea class="form-control" id="comment" name="comment"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="btnSubmitSurvey">Submit</button>
                    <button type="reset" class="btn btn-danger" name="btnReset">Reset</button>
                </div>
            </form>
        </div>
        <div class="col-invisible col-lg-3"></div>
    </div>
@endsection

@section('js')
    <script src="{{url('/')}}/js/submitSurvey.js"></script>
@endsection