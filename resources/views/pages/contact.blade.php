@extends('layouts.app')

@section('title','Contact')
@section('content')
    <div class="row content">
        <div class="col-invisible col-lg-3"></div>
        <div class="col-12 col-lg-6">
            <form action="{{url('/')}}/contact" method="post">
                @csrf
                <div class="form-group">
                    <label for="fullName">Full name:</label>
                    <input type="text" name="fullName" id="fullName" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="eMail">E-mail address:</label>
                    <input type="text" name="eMail" id="eMail" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea type="text" name="message" id="message" class="form-control" rows="7"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="btnContact">Submit</button>
                    <button type="reset" class="btn btn-danger" name="btnReset">Reset</button>
                </div>
            </form>
        </div>
        <div class="col-invisible col-lg-3"></div>
    </div>
@endsection