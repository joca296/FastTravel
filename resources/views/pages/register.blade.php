@extends('layouts.app')

@section('title','Register')
@section('content')
    <div class="row content">
        <div class="col-invisible col-lg-3"></div>
        <div class="col-12 col-lg-6">
            <form action="{{url('/')}}/register" method="post">
                @csrf
                <div class="form-group">
                    <label for="firstName">First name:</label>
                    <input type="text" name="firstName" class="form-control">
                </div>
                <div class="form-group">
                    <label for="lastName">Last name:</label>
                    <input type="text" name="lastName" class="form-control">
                </div>
                <div class="form-group">
                    <label for="eMail">E-mail address:</label>
                    <input type="text" name="eMail" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control">
                    <span class="font-italic">The password must be at least 8 characters long and contain one upper case, lower case, numerical and special character.</span>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm password:</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="btnRegister">Register</button>
                    <button type="reset" class="btn btn-danger" name="btnReset">Reset</button>
                </div>
            </form>
        </div>
        <div class="col-invisible col-lg-3"></div>
    </div>
@endsection