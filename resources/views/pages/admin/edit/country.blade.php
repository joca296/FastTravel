@extends('layouts.admin')

@section('title','Admin - Edit Country')

@section('content')
    <h1>Edit country:</h1>
    <form action="{{url('/')}}/countries/edit/{{$country->idCountry}}" method="post">
        @csrf
        <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" name="country" id="tbCountry" class="form-control" value="{{$country->countryName}}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="btnUpdate">Update</button>
            <button type="reset" class="btn btn-danger" name="btnReset">Reset</button>
        </div>
    </form>
@endsection