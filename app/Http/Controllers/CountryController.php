<?php

namespace App\Http\Controllers;

use App\Countries;
use Illuminate\Http\Request;

class CountryController extends Controller
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

        return view('pages.admin.countries')->with($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.insert.country');
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
            'country' => 'required|unique:countries,countryName'
        ]);

        $country = new Countries();

        $country->countryName = $request->input('country');

        $country->save();

        return redirect('/admin/countries');
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
        $country = Countries::find($id);

        if($country == null){
            $messageType="danger";
            $messageHeading = "Error!";
            $message = "The following location with id: ".$id." doesn't exist.";
            return view('layouts.admin')->with(['messageType'=>$messageType,'messageHeading'=>$messageHeading,'message'=>$message]);
        }

        $response = array();

        $response['country'] = $country;

        return view('pages.admin.edit.country')->with($response);
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
            'country' => 'required|unique:countries,countryName'
        ]);

        $country = Countries::find($id);

        $country->countryName = $request->input('country');

        $country->save();

        return redirect('/admin/countries');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Countries::all()->find($id);
        if($country == null){
            $messageType="danger";
            $messageHeading = "Error!";
            $message = "The following country with id: ".$id." doesn't exist.";
            return view('layouts.admin')->with(['messageType'=>$messageType,'messageHeading'=>$messageHeading,'message'=>$message]);
        }
        else{
            $country->delete();

            return redirect('/admin/countries');
        }
    }
}
