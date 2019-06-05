@extends('layouts.admin')

@section('title','Admin - Insert Location')

@section('content')
    <h1>Insert location:</h1>
    <form action="{{url('/')}}/admin/insert/location" method="post">
        @csrf
        <div class="form-group">
            <label for="country">Country:</label>
            <select class="custom-select" name="country">
                <option value="">Select...</option>
                @foreach($countries as $country)
                    <option value="{{$country->idCountry}}">{{$country->countryName}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" name="location" id="tbLocation" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="btnInsertLocation">Insert</button>
            <button type="reset" class="btn btn-danger" name="btnReset">Reset</button>
        </div>
    </form>
@endsection