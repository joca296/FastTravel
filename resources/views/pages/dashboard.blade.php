@extends('layouts.app')

@section('title','Dashboard')
@section('content')
    <div class="row content">
        <div class="col-invisible col-lg-3"></div>
        <div class="col-12 col-lg-6">
            <table class="table table-striped table-hover">
                <tr>
                    <th>First name:</th>
                    <td>{{$user->firstName}}</td>
                </tr>
                <tr>
                    <th>Last name:</th>
                    <td>{{$user->lastName}}</td>
                </tr>
                <tr>
                    <th>Email address:</th>
                    <td>{{$user->eMail}}</td>
                </tr>
                <tr>
                    <th>Taken survey:</th>
                    <td>{{$user->survey == 1? "Yes":"No"}}</td>
                </tr>
            </table>
            <a href="{{url('/')}}/user/changeEmail" class="btn btn-primary">Change email address</a>
            <a href="{{url('/')}}/user/changePassword" class="btn btn-primary">Change password</a>
            <a href="{{url('/')}}/user/delete" class="btn btn-danger">Delete account</a>
        </div>
        <div class="col-invisible col-lg-3"></div>
    </div>
@endsection