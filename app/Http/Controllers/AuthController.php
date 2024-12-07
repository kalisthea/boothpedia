<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(){
        return view("auth.login");
    }

    function loginPost(Request $request){
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $credentials = $request->only("email", "password");
        $credentials ['role'] = 'tenant';
        if(Auth::attempt($credentials)){
            return redirect()->intended(route("home"));
        }
        return redirect(route("login"));
    }
    
    function loginnum(){
        return view("auth.loginnumber");
    }

    function loginnumPost(Request $request){
        $request->validate([
            "phonenum" => "required",
            "password" => "required",
        ]);

        $credentials = $request->only("phonenum", "password");
        $credentials ['role'] = 'tenant';
        if(Auth::attempt($credentials)){
            return redirect()->intended(route("home"));
        }
        return redirect(route("loginnum"))->with("error", "Login Failed");
    }

    public function loginEO(){
        return view("auth.logineo");
    }


    function loginEOPost(Request $request){
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $credentials = $request->only("email", "password");
        $credentials ['role'] = 'eventorganizer';
        if(Auth::attempt($credentials)){
            return redirect()->intended(route("homeEO"));
        }
        return redirect(route("loginEO"));
    }
    

    function loginnumEO(){
        return view("auth.logineonum");
    }

    function loginnumEOPost(Request $request){
        $request->validate([
            "phonenum" => "required",
            "password" => "required",
        ]);

        $credentials = $request->only("phonenum", "password");
        $credentials ['role'] = 'eventorganizer';
        if(Auth::attempt($credentials)){
            return redirect()->intended(route("homeEO"));
        }
        return redirect(route("loginnumEO"))->with("error", "Login Failed");
    }


    function signup(){
        return view("auth.signup");
    }

    function signupPost(Request $request){

        
        $request->validate([
            "fullname" => "required",
            "email" => "required",
            "phonenum" => "required",
            "password" => "required",
        ]);

        $user = new User();
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->phonenum = $request->phonenum;
        $user->password = Hash::make($request->password);
        $user->role = "tenant";

        if ($user->save()){
            echo "<script type='text/javascript'>
            alert('Registration Successful!');
            window.location.href='/login';
            </script>";
        }
        else{
            echo '<script>alert("Registration Failed!")</script>';
        }
    }

    function signupEO(){
        return view("auth.register");
    }

    function signupEOPost(Request $request){
        
        $request->validate([
            "fullname" => "required",
            "email" => "required",
            "phonenum" => "required",
            "password" => "required",
        ]);

        $user = new User();
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->phonenum = $request->phonenum;
        $user->password = Hash::make($request->password);
        $user->role = "eventorganizer";

        if ($user->save()){
            echo "<script type='text/javascript'>
            alert('Registration Successful!');
            window.location.href='/login-eo';
            </script>";
        }
        else{
            echo '<script>alert("Registration Failed!")</script>';
        }
    }
}
