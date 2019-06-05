@extends('layouts.admin')

@section('title','Admin - Insert Country')

@section('content')
    <h1>Insert country:</h1>
    <form action="{{url('/')}}/admin/insert/country" method="post">
        @csrf
        <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" name="country" id="tbCountry" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="btnInsertCountry">Insert</button>
            <button type="reset" class="btn btn-danger" name="btnReset">Reset</button>
        </div>
    </form>
@endsection