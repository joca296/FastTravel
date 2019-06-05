<?php

namespace App\Http\Controllers;

use App\Countries;
use App\Locations;
use App\Offers;
use App\Pictures;
use App\Seasons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = array();

        $response['countries'] = Countries::all();
        $response['seasons']  = Seasons::all();
        $response['offers'] = Offers::paginate(3);

        return view('pages.offers')->with($response);
    }

    public function indexTable(){
        $response = array();

        $response['offers']=Offers::all();

        return view('pages.admin.offers')->with($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = array();
        $response['countries'] = Countries::all();
        $response['seasons']  = Seasons::all();

        return view('pages.admin.insert.offer')->with($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'country' => 'required|exists:countries,idCountry',
            'location' => 'required|exists:locations,idLocation',
            'season' => 'required|exists:seasons,idSeason',
            'price' => 'required|numeric',
            'description' => 'required',
            'picture' => 'required|image|dimensions:ratio=16/9',
            'pictureAlt' => 'required'
        ]);

        $country = $request->input('country');
        $location = $request->input('location');
        $season = $request->input('season');
        $price = $request->input('price');
        $description = $request->input('description');
        $picture = $request->file('picture');
        $pictureAlt = $request->input('pictureAlt');

        $image = New Pictures();

        $path="/images/".time().$picture->getClientOriginalName();
        $picture->move(public_path()."/images/",time().$picture->getClientOriginalName());
        $image->src = $path;
        $image->alt = $pictureAlt;

        $image->save();

        $offer = new Offers();

        $offer->idCountry = $country;
        $offer->idLocation = $location;
        $offer->idSeason = $season;
        $offer->price = $price;
        $offer->description = $description;
        $offer->idPicture = $image->idPicture;

        $offer->save();

        return redirect('/admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $offer = Offers::find($id);
        if($offer == null) {
            $messageType="danger";
            $messageHeading = "Error!";
            $message = "The following offer with id: ".$id." doesn't exist.";
            return view('layouts.app')->with(['messageType'=>$messageType,'messageHeading'=>$messageHeading,'message'=>$message]);
        }
        return view('pages.offer')->with(['offer'=>$offer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $offer = Offers::find($id);

        if($offer == null){
            $messageType="danger";
            $messageHeading = "Error!";
            $message = "The following offer with id: ".$id." doesn't exist.";
            return view('layouts.admin')->with(['messageType'=>$messageType,'messageHeading'=>$messageHeading,'message'=>$message]);
        }

        $response = array();

        $response['offer'] = $offer;
        $response['countries'] = Countries::all();
        $response['locations'] = Locations::all()->where('idCountry','=',$offer->idCountry);
        $response['seasons'] = Seasons::all();

        return view('pages.admin.edit.offer')->with($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'country' => 'required|exists:countries,idCountry',
            'location' => 'required|exists:locations,idLocation',
            'season' => 'required|exists:seasons,idSeason',
            'price' => 'required|numeric',
            'description' => 'required',
            'picture' => 'sometimes|image|dimensions:ratio=16/9',
            'pictureAlt' => 'required'
        ]);

        $country = $request->input('country');
        $location = $request->input('location');
        $season = $request->input('season');
        $price = $request->input('price');
        $description = $request->input('description');
        $pictureAlt = $request->input('pictureAlt');

        $offer = Offers::find($id);

        $offer->idCountry = $country;
        $offer->idLocation = $location;
        $offer->idSeason = $season;
        $offer->price = $price;
        $offer->description = $description;

        $offer->save();

        $image = Pictures::find($offer->idPicture);

        $image->alt = $pictureAlt;
        if($request->hasFile('picture')){

            $picture = $request->file('picture');
            $picture->move(public_path()."/images/",time().$picture->getClientOriginalName());

            File::delete(public_path().$image->src);

            $path="/images/".time().$picture->getClientOriginalName();
            $image->src = $path;
        }
        $image->save();

        return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offer = Offers::all()->find($id);
        if($offer == null){
            $messageType="danger";
            $messageHeading = "Error!";
            $message = "The following offer with id: ".$id." doesn't exist.";
            return view('layouts.admin')->with(['messageType'=>$messageType,'messageHeading'=>$messageHeading,'message'=>$message]);
        }
        else{
            $offer->delete();

            return redirect('/admin');
        }
    }

    public function search(Request $request){
        $response = array();

        $response['countries'] = Countries::all();
        $response['seasons'] = Seasons::all();

        $idCountry = $request->input('country');
        $idLocation = $request->input('location');
        $idSeason = $request->input('season');
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $sort = $request->input('sort');

        $offers = Offers::all();

        if(is_numeric($idCountry)) $offers = $offers->where('idCountry','=',$idCountry);
        if(is_numeric($idLocation)) $offers = $offers->where('idLocation','=',$idLocation);
        if(is_numeric($idSeason)) $offers = $offers->where('idSeason','=',$idSeason);
        if(is_numeric($minPrice)) $offers = $offers->where('price','>=',$minPrice);
        if(is_numeric($maxPrice)) $offers = $offers->where('price','<=',$maxPrice);
        switch ($sort){
            case "locationNameASC": $offers = $offers->sortBy('location.locationName'); break;
            case "locationNameDESC": $offers = $offers->sortByDesc('location.locationName'); break;
            case "priceASC": $offers = $offers->sortBy('price'); break;
            case "priceDESC": $offers = $offers->sortByDesc('price'); break;
        }

        if($offers->count() == 0){
            $response['messageType']='warning';
            $response['messageHeading']='No Results!';
            $response['message']='There are no offers with these search parameters.';
        }
        $response['offers'] = $offers;
        $response['noPagination'] = 1;

        return view('pages.offers')->with($response);
    }
}
