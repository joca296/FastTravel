<?php

namespace App\Http\Controllers;

use App\User;
use App\UserDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        return view('pages.dashboard')->with('user',$user);
    }

    public function create()
    {
        return view('pages.register');
    }

    public function store(Request $request)
    {
        $nameRegex = "/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u";
        $emailRegex = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
        $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/";

        $request->validate([
            'firstName' => 'required|regex:'.$nameRegex,
            'lastName' => 'required|regex:'.$nameRegex,
            'eMail' => 'required|unique:users,eMail|regex:'.$emailRegex,
            'password' => 'required|confirmed|regex:'.$passwordRegex,
        ]);

        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $eMail = $request->input('eMail');
        $password = $request->input('password');

        $user = new User();

        $user->admin=0;
        $user->survey=0;
        $user->activated=0;
        $user->validateKey=sha1(uniqid());

        $user->firstName=$firstName;
        $user->lastName=$lastName;
        $user->eMail=$eMail;
        $user->password=Hash::make($password);

        $user->save();

        $subject = "Fast Travel - Account activation";
        $message = "Thank you for registering on our website. In order to activate your account, please use the following link: ".url('/')."/validate/".$user->validateKey;
        mail($eMail,$subject,$message);

        $response = array();
        $response['messageType']="success";
        $response['messageHeading']="Success!";
        $response['message']="You have registered on our website. Please check your email in order to activate your account.";

        return view('pages.register')->with($response);
    }

    public function validateUser($key){
        $user = User::all()->where('validateKey','=',$key);

        if($user->count() == 1){
            $user->first()->activated=1;
            $user->first()->validateKey="";

            $user->first()->save();

            $response = array();
            $response['messageType']="success";
            $response['messageHeading']="Success!";
            $response['message']="You have activated your account.";
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

    public function login(Request $request){
        $credentials = array();

        $credentials['eMail'] = $request->input('eMail');
        $credentials['password']  = $request->input('password');
        $credentials['activated'] = 1;

        if(Auth::attempt($credentials)){
            return redirect()->intended('/');
        }
        else{
            $loginError = "Incorrect login information.";
            return redirect()->back()->with('loginError',$loginError);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function delete(){
        $user = Auth::user();

        $userDelete = new UserDeletes();

        $userDelete->idUser=$user->idUser;
        $userDelete->validateKey=sha1(uniqid());

        $userDelete->save();

        $subject = "Fast Travel - Account deletion";
        $message = "You have requested to delete your account on our website. In order to confirm the deletion, please use the following link: ".url('/')."/validateUserDelete/".$userDelete->validateKey;
        mail($user->eMail,$subject,$message);

        $response = array();
        $response['user']=$user;
        $response['messageType']="warning";
        $response['messageHeading']="Success!";
        $response['message']="You have requested to delete your account on our website. Please check your email inbox in order to apply the deletion.";

        return view('pages.dashboard')->with($response);
    }

    public function validateDelete($key){
        $userDelete = UserDeletes::all()->where('validateKey','=',$key);

        if($userDelete->count() == 1){
            $user=User::find($userDelete->first()->idUser);
            if(Auth::check() && Auth::user() == $user) Auth::logout();
            $userDelete->first()->delete();
            $user->delete();

            $response = array();
            $response['messageType']="warning";
            $response['messageHeading']="Success!";
            $response['message']="You have deleted your account.";
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
