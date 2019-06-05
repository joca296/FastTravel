@extends('layouts.admin')

@section('title','Admin - Insert Offer')

@section('content')
    <h1>Insert offer</h1>
    <form action="{{url('/')}}/admin/insert/offer" method="post" enctype="multipart/form-data">
        <div class="form-group">
            @csrf
            <label for="country">Country:</label>
            <select class="custom-select" name="country" id="sCountry">
                <option value="">Country...</option>
                @foreach($countries as $country)
                    <option value="{{$country->idCountry}}">{{$country->countryName}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="location">Location:</label>
            <select class="custom-select mr-2" name="location" id="sLocation">
                <option value="">Location...</option>
            </select>
        </div>
        <div class="form-group">
            <label for="season">Season:</label>
            <select class="custom-select" name="season" id="sSeason">
                <option value="">Season...</option>
                @foreach($seasons as $season)
                    <option value="{{$season->idSeason}}">{{$season->seasonName}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" name="price" id="tbPrice" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="taDescription" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="picture">Image:</label>
            <input type="file" name="picture" id="fPicture" class="form-control-file">
            <span class="font-italic">Picture must be in 16:9 aspect ratio.</span>
        </div>
        <div class="form-group">
            <label for="pictureAlt">Image Alt:</label>
            <input type="text" name="pictureAlt" id="tbPictureAlt" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="btnInsertOffer">Insert</button>
            <button type="reset" class="btn btn-danger" name="btnReset">Reset</button>
        </div>
    </form>
@endsection

@section('js')
    <script src="{{url('/')}}/js/locationFilter.js"></script>
@endsection