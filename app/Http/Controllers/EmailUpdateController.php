<?php

namespace App\Http\Controllers;

use App\EmailUpdates;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailUpdateController extends Controller
{
    public function edit(){
        return view('pages.updateEmail');
    }

    public function update(Request $request){
        $emailRegex = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";

        $request->validate([
            'newEmail' => 'required|unique:users,eMail|regex:'.$emailRegex
        ]);

        $emailUpdate = new EmailUpdates();

        $emailUpdate->idUser = Auth::user()->idUser;
        $emailUpdate->newEmail = $request->input('newEmail');
        $emailUpdate->validateKey = sha1(uniqid());

        $emailUpdate->save();

        $subject = "Fast Travel - Email Update";
        $message = "You have sent a request to change your email address. In order to apply the change, please use the following link: ".url('/')."/validateEmailChange/".$emailUpdate->validateKey;
        mail(Auth::user()->eMail,$subject,$message);

        $response = array();
        $response['messageType']="success";
        $response['messageHeading']="Success!";
        $response['message']="You have sent a request to change your email address. Please check your old email inbox in order to apply the change.";

        return view('pages.updateEmail')->with($response);
    }

    public function validateUpdate($key){
        $emailUpdate = EmailUpdates::all()->where('validateKey','=',$key);

        if($emailUpdate->count() == 1){
            $user = User::all()->where('idUser','=',$emailUpdate->first()->idUser);
            $user->first()->eMail = $emailUpdate->first()->newEmail;
            $user->first()->save();
            $emailUpdate->first()->delete();

            $response = array();
            $response['messageType']="success";
            $response['messageHeading']="Success!";
            $response['message']="You have successfully changed your email address, you can now log in with your new email address.";
            $response['showHomeLink']=1;

            return view('layouts.app')->with($response);
        }
        else{
            $response = array();
            $response['messageType']="danger";
            $response['messageHeading']="Error!";
            $response['message']="Invalid validation key.";
            $response['showHomeLink']=1;

            return view('layouts.app')->with($response);
        }
    }
}
