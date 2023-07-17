<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PageController extends Controller
{
    function registrationPage(){

        return view('pages.registration');

    }

    function loginPage(){

        return view('pages.login');
    }

    function forgotPasswordPage(){

        return view('pages.forgotPassword');
    }


    function confirmOTPPage(){

        return view('pages.confirOTP');
    }

    function resetPasswordPage(){
        return view('pages.resetPassword');
    }

    function dashboard(Request $request){
        
        $token = Cookie::get('token');

        if($token!=null){
            return view('pages.dashboard');
        }else{
            return "<h3>Access Denied! <br> Only Valid User can visit this page!</h3>";
        }
    }
}
