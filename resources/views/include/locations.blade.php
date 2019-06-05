<option value="">Location...</option>
@foreach($locations as $location)
    <option value="{{$location->idLocation}}">{{$location->locationName}}</option>
@endforeach