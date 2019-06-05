@extends('layouts.app')

@section('title','Offers')
@section('content')
    <nav class="navbar navbar-expand-xl navbar-dark bg-dark">
        <span class="navbar-brand d-xl-none">Search</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav1" aria-controls="navbarNav1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav1">
            <form action="{{url('/')}}/offers" method="POST" class="form-inline my-2 my-lg-0" id="searchOffers">
                @csrf
                <select class="custom-select mr-2" name="country" id="sCountry">
                    <option value="selectCountry">Country...</option>
                    @foreach($countries as $country)
                        <option value="{{$country->idCountry}}">{{$country->countryName}}</option>
                    @endforeach
                </select>
                <select class="custom-select mr-2" name="location" id="sLocation">
                    <option value="selectLocation">Location...</option>
                </select>
                <select class="custom-select mr-2" name="season" id="sSeason">
                    <option value="selectSeason">Season...</option>
                    @foreach($seasons as $season)
                        <option value="{{$season->idSeason}}">{{$season->seasonName}}</option>
                    @endforeach
                </select>
                <input type="number" class="form-control mr-2 col-xl-2" name="minPrice" id="minPrice" placeholder="Minimum price">
                <input type="number" class="form-control mr-2 col-xl-2" name="maxPrice" id="maxPrice" placeholder="Maximum price">
                <select class="custom-select mr-2" name="sort" id="sSort">
                    <option value="sort">Sort...</option>
                    <option value="locationNameASC">Name A-Z</option>
                    <option value="locationNameDESC">Name Z-A</option>
                    <option value="priceASC">Price ascending</option>
                    <option value="priceDESC">Price descending</option>
                </select>
                <button type="submit" class="btn btn-outline-success mr-2" name="btnSearch">Search</button>
            </form>
        </div>
    </nav>
    <div class="row content" id="offers">
    @foreach($offers as $offer)
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <img src="{{url('/').$offer->picture->src}}" class="card-img-top" alt="{{$offer->picture->alt}}">
                    <div class="card-body">
                        <h4 class="card-title">{{$offer->location->locationName}} - {{$offer->country->countryName}}</h4>
                        <h5 class="card-title">{{$offer->season->seasonName}}</h5>
                        <p class="card-text text-justify text-truncate">{{$offer->description}}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{url('/')}}/offers/{{$offer->idOffer}}" class="btn btn-outline-dark">More</a>
                            <span class="card-text font-weight-bold">${{$offer->price}}</span>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach
        @if(!isset($noPagination))
            <div class="col-12">
                {{$offers->links()}}
            </div>
        @endif
    </div>
@endsection

@section('js')
    <script src="{{url('/')}}/js/locationFilter.js"></script>
@endsection