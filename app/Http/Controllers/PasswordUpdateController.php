<?php

namespace App\Http\Controllers;

use App\PasswordUpdates;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordUpdateController extends Controller
{
    public function edit(){
        return view('pages.updatePassword');
    }

    public function update(Request $request){
        $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/";

        $request->validate([
            'newPassword' => 'required|confirmed|regex:'.$passwordRegex
        ]);

        $passwordUpdate = new PasswordUpdates();

        $passwordUpdate->idUser = Auth::user()->idUser;
        $passwordUpdate->newPassword = Hash::make($request->input('newPassword'));
        $passwordUpdate->validateKey = sha1(uniqid());

        $passwordUpdate->save();

        $subject = "Fast Travel - Password Update";
        $message = "You have sent a request to change your password. In order to apply the change, please use the following link: ".url('/')."/validatePasswordChange/".$passwordUpdate->validateKey;
        mail(Auth::user()->eMail,$subject,$message);

        $response = array();
        $response['messageType']="success";
        $response['messageHeading']="Success!";
        $response['message']="You have sent a request to change your password. Please check your email inbox in order to apply the change.";

        return view('pages.updatePassword')->with($response);
    }

    public function validateUpdate($key){
        $passwordUpdate = PasswordUpdates::all()->where('validateKey','=',$key);

        if($passwordUpdate->count() == 1){
            $user = User::all()->where('idUser','=',$passwordUpdate->first()->idUser);
            $user->first()->password = $passwordUpdate->first()->newPassword;
            $user->first()->save();
            $passwordUpdate->first()->delete();

            $response = array();
            $response['messageType']="success";
            $response['messageHeading']="Success!";
            $response['message']="You have successfully changed your password, you can now log in with your new password.";
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
