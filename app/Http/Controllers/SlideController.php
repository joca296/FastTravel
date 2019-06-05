<?php

namespace App\Http\Controllers;

use App\Pictures;
use App\Slides;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PhpParser\Node\Expr\AssignOp\ShiftLeft;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response= array();

        $response['slides'] = Slides::all();

        return view('pages.admin.slides')->with($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.insert.slide');
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
            'caption' => 'required',
            'subCaption' => 'required',
            'picture' => 'required|image|dimensions:ratio=16/9',
            'pictureAlt' => 'required'
        ]);

        $caption = $request->input('caption');
        $subCaption = $request->input('subCaption');
        $picture = $request->file('picture');
        $pictureAlt = $request->input('pictureAlt');

        $image = New Pictures();

        $path="/images/".time().$picture->getClientOriginalName();
        $picture->move(public_path()."/images/",time().$picture->getClientOriginalName());
        $image->src = $path;
        $image->alt = $pictureAlt;

        $image->save();

        $slide = new Slides();

        $slide->caption = $caption;
        $slide->subCaption = $subCaption;
        $slide->idPicture = $image->idPicture;

        $slide->save();

        return redirect('/admin/slides');
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
        $slide = Slides::find($id);

        if($slide == null){
            $messageType="danger";
            $messageHeading = "Error!";
            $message = "The following slide with id: ".$id." doesn't exist.";
            return view('layouts.admin')->with(['messageType'=>$messageType,'messageHeading'=>$messageHeading,'message'=>$message]);
        }

        $response = array();

        $response['slide'] = $slide;

        return view('pages.admin.edit.slide')->with($response);
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
            'caption' => 'required',
            'subCaption' => 'required',
            'picture' => 'sometimes|image|dimensions:ratio=16/9',
            'pictureAlt' => 'required'
        ]);

        $slide = Slides::find($id);

        $slide->caption = $request->input('caption');
        $slide->subCaption = $request->input('subCaption');

        $slide->save();

        $image = Pictures::find($slide->idPicture);

        $image->alt = $request->input('pictureAlt');
        if($request->hasFile('picture')){

            $picture = $request->file('picture');
            $picture->move(public_path()."/images/",time().$picture->getClientOriginalName());

            File::delete(public_path().$image->src);

            $path="/images/".time().$picture->getClientOriginalName();
            $image->src = $path;
        }
        $image->save();

        return redirect('/admin/slides');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slides::all()->find($id);
        if($slide == null){
            $messageType="danger";
            $messageHeading = "Error!";
            $message = "The following slide with id: ".$id." doesn't exist.";
            return view('layouts.admin')->with(['messageType'=>$messageType,'messageHeading'=>$messageHeading,'message'=>$message]);
        }
        else{
            $slide->delete();

            return redirect('/admin/slides');
        }
    }
}
