<?php

namespace App\Http\Controllers;

use App\Countries;
use App\Locations;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = array();

        $response['locations'] = Locations::all();

        return view('pages.admin.locations')->with($response);
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

        return view('pages.admin.insert.location')->with($response);
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
            'location' => 'required'
        ]);

        $location = new Locations();

        $location->idCountry = $request->input('country');
        $location->locationName = $request->input('location');

        $location->save();

        return redirect('/admin/locations');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = Locations::find($id);

        if($location == null){
            $messageType="danger";
            $messageHeading = "Error!";
            $message = "The following location with id: ".$id." doesn't exist.";
            return view('layouts.admin')->with(['messageType'=>$messageType,'messageHeading'=>$messageHeading,'message'=>$message]);
        }

        $response = array();

        $response['location'] = $location;
        $response['countries'] = Countries::all();

        return view('pages.admin.edit.location')->with($response);
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
            'location' => 'required'
        ]);

        $location = Locations::find($id);

        $location->idCountry = $request->input('country');
        $location->locationName = $request->input('location');

        $location->save();

        return redirect('/admin/locations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Locations::all()->find($id);
        if($location == null){
            $messageType="danger";
            $messageHeading = "Error!";
            $message = "The following location with id: ".$id." doesn't exist.";
            return view('layouts.admin')->with(['messageType'=>$messageType,'messageHeading'=>$messageHeading,'message'=>$message]);
        }
        else{
            $location->delete();

            return redirect('/admin/locations');
        }
    }

    public function filter(Request $request){
        $locations = Locations::all()->where('idCountry',$request->input('idCountry'));
        return view('include.locations')->with('locations',$locations);
    }
}
