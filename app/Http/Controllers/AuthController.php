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
        if(Auth::attempt($credentials)){
            return redirect()->intended(route("home"));
        }
        return redirect(route("login"))->with("error", "Login Failed");
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
        if(Auth::attempt($credentials)){
            return redirect()->intended(route("home"));
        }
        return redirect(route("loginnum"))->with("error", "Login Failed");
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
}
