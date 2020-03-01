<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:student');
    }

    public function showLoginForm(){
        return view('auth.admin-login');
    }

    public function login(Request $request){
        // validates the form data
        $this->validate($request,[
           'email' => 'required|email',
           'password' => 'required|min:6'
        ]);

        // Attemt to log the user to
        if(Auth::guard('student')->attempt(['email' =>$request->email,'password' => $request->password],$request->remember)){
         // if successful, then redirect to their intended location
        return view('home');
        }

        // if unsuccessful, then redirect back to the login with the form data
        return "Login in unsuccessful";
    }
}
