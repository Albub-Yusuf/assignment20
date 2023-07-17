<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    function userRegistration(Request $request){
       
        try{

            User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'password' => md5($request->input('password'))
            ]);

            return response()->json([
                'status' => 'Success',
                'message' => 'User Registration Successful!'
            ],200);

        }
        catch(Exception $err){
            return response()->json([
                'status' => 'failed!',
                'message' => 'Something Went Wrong!',
                'error' => $err
            ]);
        }

    }

    function userLogin(Request $request){
    
        $password = md5($request->input('password'));
     
        $hasUser = User::where('email',$request->input('email'))
                        ->where('password',$password)
                        ->count();

        if($hasUser == 1){
            //$token = JWTToken::CreateToken($request->input('email'));
            //$token ='Test';
            $token = JWTToken::CreateToken($request->input('email'));
            return response()->json([
                'status' => 'Success',
                'message' => 'User Login Successful!'
            ],200)->cookie('token',$token,60*60*24);
        }
        else{

            return response()->json([
                'status'=>'failed',
                'message'=>'Unauthorized'
            ],401);
        }
    }

    function sendOtp(Request $request){

        $email = $request->input('email');
        $otp = rand(1000,9999);
        $hasEmail = User::where('email',$email)->count();

        if($hasEmail==1){

            // Send otp mail
            Mail::to($email)->send(new OTPMail($otp));

            // OTP update on users table
            User::where('email',$email)->update(['otp'=>$otp]);

            return response()->json([
                'status'=>'Success!',
                'message'=>'OTP has been sent to your email address'
            ],200);


        }else{
            return response()->json([
                'status'=>'Failed!',
                'message'=>'Email is not associated with the system!'
            ],401);
        }
    }

    function verifyOTP(Request $request){
        $email = $request->input('email');
        $otp = $request->input('otp');
        $count = User::where('email',$email)
                       ->where('otp',$otp)->count();

        if($count==1){
            // Update OTP
            User::where('email',$email)->update(['otp'=>'0']);


            // Issue new token
            $token = JWTToken::CreateTokenForSetPassword($request->input('email'));
            return response()->json([
                'status'=>'Success!',
                'message'=>'OTP verification successful!',
                'token'=>$token
            ],200)->cookie('token',$token,60*60*24);

        }else{
            return response()->json([
                'status'=>'failed!',
                'message'=>'Unauthorized'
            ],401);
        }
    }

    function ResetPass(Request $request){
       
        try{
            $email = $request->header('email');
            $password = md5($request->input('password'));
            User::where('email',$email)->update(['password'=>$password]);
            return response()->json([
                'status'=>'success',
                'message'=>'Password Reset Successfully!'
            ],200);
        }catch(Exception $e){

            return response()->json([
                'status'=>'failed!',
                'message'=>'Something went wrong!'
            ]);

        }
    }

    function logout(){
        
        return redirect('/')->withCookie(Cookie::forget('token'));
    }

    
}
