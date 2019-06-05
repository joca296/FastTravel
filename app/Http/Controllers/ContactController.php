<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.contact');
    }

    public function submit(Request $request)
    {
        $nameRegex = "/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u";
        $emailRegex = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";

        $request->validate([
            'fullName' => 'required|regex:'.$nameRegex,
            'eMail' => 'required|regex:'.$emailRegex,
            'title' => 'required',
            'message' => 'required',
        ]);

        $fullName = $request->input('fullName');
        $eMail = $request->input('eMail');
        $title = $request->input('title');
        $messageToAdmin = $request->input('message');

        $to = "joca296burner@gmail.com";
        $title = "Fast Travel contact page | ".$title;
        $messageToAdmin = "From: ".$fullName."\r\nE-mail address: ".$eMail."\r\nMessage:\r\n".$messageToAdmin;
        mail($to,$title,$messageToAdmin);

        $return = array();
        $return['messageType'] = 'success';
        $return['messageHeading'] = 'Success';
        $return['message'] = 'You have sent an e-mail to the site administrator.';

        return view('pages.contact')->with($return);
    }

}
