@extends('layouts.admin')

@section('title','Admin - Edit Location')

@section('content')
    <h1>Edit location:</h1>
    <form action="{{url('/')}}/locations/edit/{{$location->idLocation}}" method="post">
        @csrf
        <div class="form-group">
            <label for="country">Country:</label>
            <select class="custom-select" name="country">
                <option value="">Select...</option>
                @foreach($countries as $country)
                    <option value="{{$country->idCountry}}" {{$location->idCountry == $country->idCountry ? 'selected' : ''}}>{{$country->countryName}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" name="location" id="tbLocation" class="form-control" value="{{$location->locationName}}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="btnUpdate">Update</button>
            <button type="reset" class="btn btn-danger" name="btnReset">Reset</button>
        </div>
    </form>
@endsection