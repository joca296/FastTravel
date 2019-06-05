@extends('layouts.app')

@section('title','Change Password')
@section('content')
    <div class="row content">
        <div class="col-invisible col-lg-3"></div>
        <div class="col-12 col-lg-6">
            <form action="{{url('/')}}/user/changePassword" method="POST">
                @csrf
                <div class="form-group">
                    <label for="newPassword">New password:</label>
                    <input type="password" name="newPassword" class="form-control">
                </div>
                <div class="form-group">
                    <label for="newPassword_confirmation">Confirm password:</label>
                    <input type="password" name="newPassword_confirmation" class="form-control">
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