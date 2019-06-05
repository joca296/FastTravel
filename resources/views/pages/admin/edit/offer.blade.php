@extends('layouts.admin')

@section('title','Admin - Edit Offer')

@section('content')
    <h1>Edit offer</h1>
    <form action="{{url('/')}}/offers/edit/{{$offer->idOffer}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            @csrf
            <label for="country">Country:</label>
            <select class="custom-select" name="country" id="sCountry">
                <option value="">Country...</option>
                @foreach($countries as $country)
                    <option value="{{$country->idCountry}}" {{$offer->country->idCountry == $country->idCountry ? 'selected' : ''}}>{{$country->countryName}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="location">Location:</label>
            <select class="custom-select mr-2" name="location" id="sLocation">
                <option value="">Location...</option>
                @foreach($locations as $location)
                    <option value="{{$location->idLocation}}" {{$offer->location->idLocation == $location->idLocation ? 'selected' : ''}}>{{$location->locationName}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="season">Season:</label>
            <select class="custom-select" name="season" id="sSeason">
                <option value="">Season...</option>
                @foreach($seasons as $season)
                    <option value="{{$season->idSeason}}" {{$offer->season->idSeason == $season->idSeason ? 'selected' : ''}}>{{$season->seasonName}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" name="price" id="tbPrice" class="form-control" value="{{$offer->price}}">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="taDescription" class="form-control">{{$offer->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="picture">Image:</label>
            <input type="file" name="picture" id="fPicture" class="form-control-file">
            <span class="font-italic">Picture must be in 16:9 aspect ratio.</span>
        </div>
        <div class="form-group">
            <label for="pictureAlt">Image Alt:</label>
            <input type="text" name="pictureAlt" id="tbPictureAlt" class="form-control" value="{{$offer->picture->alt}}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="btnUpdate">Update</button>
            <button type="reset" class="btn btn-danger" name="btnReset">Reset</button>
        </div>
    </form>
@endsection

@section('js')
    <script src="{{url('/')}}/js/locationFilter.js"></script>
@endsection