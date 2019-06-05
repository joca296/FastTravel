@extends('layouts.app')

@section('title','Reservations')

@section('content')
    <div class="row content">
        <div class="col">
            <table class="table table-striped">
                <thead class="table-dark">
                    <th>#</th>
                    <th>Location</th>
                    <th>Price</th>
                    <th>Number of people</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <td>{{$reservation->idReservation}}</td>
                            <td>{{$reservation->offer->location->locationName." - ".$reservation->offer->country->countryName}}</td>
                            <td>${{$reservation->offer->price*$reservation->numberOfPeople}}</td>
                            <td>{{$reservation->numberOfPeople}}</td>
                            <td>
                                <a href="{{url('/')}}/user/reservations/cancel/{{$reservation->idReservation}}" class="btn btn-outline-danger">Cancel</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection