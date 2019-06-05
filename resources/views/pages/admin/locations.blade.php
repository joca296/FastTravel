@extends('layouts.admin')

@section('title','Admin - Location List')

@section('content')
    <h1>Locations</h1>
    <div class="table-responsive-sm">
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
            <th>#</th>
            <th>Country</th>
            <th>Name</th>
            <th class="text-center">Action</th>
            </thead>
            <tbody>
            @foreach($locations as $location)
                <tr>
                    <th scope="row" class="idOffer">{{$location->idLocation}}</th>
                    <td>{{$location->country->countryName}}</td>
                    <td>{{$location->locationName}}</td>
                    <td class="text-center" style="max-width: 80px">
                        <a href="{{url('/')}}/locations/edit/{{$location->idLocation}}" class="btn btn-outline-primary">Update</a>
                        <a href="{{url('/')}}/locations/delete/{{$location->idLocation}}" class="btn btn-outline-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection