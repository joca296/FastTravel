@extends('layouts.admin')

@section('title','Survey Results')

@section('content')
    <h1>Survey Results</h1>
    <div class="table-responsive-sm">
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
            <th scope="col">#</th>
            <th scope="col">Full name</th>
            @foreach($questions as $question)
                <th scope="col">{{$question->question}}</th>
            @endforeach
            <th scope="col">Comment</th>
            </thead>
            <tbody>
            @foreach($results as $result)
                <th scope="row">{{$result->idResult}}</th>
                <td>{{$result->user->firstName." ".$result->user->lastName}}</td>
                <td>{{$result->answer1->answer}}</td>
                <td>{{$result->answer2->answer}}</td>
                <td>{{$result->comment}}</td>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection