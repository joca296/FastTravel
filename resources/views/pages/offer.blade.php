@extends('layouts.app')

@section('title',$offer->location->locationName)
@section('content')
    <div class="row content">
        <div class="col-12 col-lg-6">
            <div style="position: relative" id="modalImageSmall" data-toggle="modal" data-target="#modalImage">
                <img src="{{url('/').$offer->picture->src}}" class="rounded img-fluid" alt="{{$offer->picture->alt}}">
                <div class="rounded centered">Click to enlarge</div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <h5 class="card-header">{{$offer->location->locationName}} -{{$offer->country->countryName}}</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Time of year: {{$offer->season->seasonName}}</li>
                    <li class="list-group-item">Price (including hotel and transport): ${{$offer->price}}</li>
                    <li class="list-group-item text-justify">
                        Description of the location:<br/>
                        <p style="margin-top: 10px;">{{$offer->description}}</p>
                    </li>
                    @if(Auth::check())
                        <li class="list-group-item">
                            <form action="{{url('/')}}/reserve/{{$offer->idOffer}}" method="post" class="form-inline justify-content-between" id="reserve">
                                @csrf
                                <input id="idOffer" value="{{$offer->idOffer}}" class="d-none">
                                <input type="number" name="numberOfPeople" id="numberOfPeople" placeholder="Number of people" class="form-control">
                                <button type="submit" class="btn btn-primary">Reserve</button>
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalImage" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$offer->location->locationName}} -{{$offer->country->countryName}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img data-toggle="modal" data-target="#modalImage" src="{{url('/').$offer->picture->src}}" class="rounded img-fluid" alt="{{$offer->picture->alt}}">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{url('/')}}/js/offer.js"></script>
@endsection