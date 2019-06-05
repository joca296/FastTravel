@extends('layouts.admin')

@section('title','Admin - Offer List')

@section('content')
    <h1>Offers</h1>
    <div class="table-responsive-sm">
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
            <th>#</th>
            <th>Location</th>
            <th>Country</th>
            <th>Season</th>
            <th>Price</th>
            <th>Description</th>
            <th class="text-center">Action</th>
            </thead>
            <tbody>
            @foreach($offers as $offer)
                <tr>
                    <th scope="row" class="idOffer">{{$offer->idOffer}}</th>
                    <td>{{$offer->location->locationName}}</td>
                    <td>{{$offer->country->countryName}}</td>
                    <td>{{$offer->season->seasonName}}</td>
                    <td>${{$offer->price}}</td>
                    <td class="text-truncate" style="max-width: 250px">{{$offer->description}}</td>
                    <td class="text-center" style="max-width: 80px">
                        <a href="{{url('/')}}/offers/edit/{{$offer->idOffer}}" class="btn btn-outline-primary">Update</a>
                        <a href="{{url('/')}}/offers/delete/{{$offer->idOffer}}" class="btn btn-outline-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection