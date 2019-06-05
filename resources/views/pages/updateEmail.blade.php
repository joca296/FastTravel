@extends('layouts.app')

@section('title','Change Email')
@section('content')
    <div class="row content">
        <div class="col-invisible col-lg-3"></div>
        <div class="col-12 col-lg-6">
            <form action="{{url('/')}}/user/changeEmail" method="POST">
                @csrf
                <div class="form-group">
                    <label for="newEmail">New email address:</label>
                    <input type="text" name="newEmail" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="btnUpdate">Update</button>
                    <button type="reset" class="btn btn-danger" name="btnReset">Reset</button>
                    <a href="{{url('/')}}/user/dashboard" class="btn btn-warning">Return to dashboard</a>
                </div>
            </form>
        </div>
        <div class="col-invisible col-lg-3"></div>
    </div>
@endsection