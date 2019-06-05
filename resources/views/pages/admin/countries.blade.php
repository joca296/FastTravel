@extends('layouts.admin')

@section('title','Admin - Country List')

@section('content')
    <h1>Countries</h1>
    <div class="table-responsive-sm">
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
            <th>#</th>
            <th>Name</th>
            <th class="text-center">Action</th>
            </thead>
            <tbody>
            @foreach($countries as $country)
                <tr>
                    <th scope="row" class="idOffer">{{$country->idCountry}}</th>
                    <td>{{$country->countryName}}</td>
                    <td class="text-center" style="max-width: 80px">
                        <a href="{{url('/')}}/countries/edit/{{$country->idCountry}}" class="btn btn-outline-primary">Update</a>
                        <a href="{{url('/')}}/countries/delete/{{$country->idCountry}}" class="btn btn-outline-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection