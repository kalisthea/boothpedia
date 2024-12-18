<?php

namespace App\Http\Controllers;

use App\Models\Eventorganizer;
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
            return redirect()->intended('home');
        }
        return redirect(route("login"))->withErrors(['email' => 'The provided credentials do not match our records.']);
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
            return redirect()->intended("home");
        }
        return redirect(route("loginnum"))->withErrors(['phonenum' => 'The provided credentials do not match our records.']);
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
            return redirect()->intended("dashboard");
        }
        return redirect(route("loginEO"))->withErrors(['email' => 'The provided credentials do not match our records.']);
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
            return redirect()->intended("dashboard");
        }
        return redirect(route("loginnumEO"))->withErrors(['phonenum' => 'The provided credentials do not match our records.']);
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
            alert('Tenant Registration Successful!');
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
            "email" => "required|email|unique:users,email",
            "phonenum" => "required|unique:users,phonenum",
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
            alert('Event Organizer Registration Successful!');
            window.location.href='/login-eo';
            </script>";
        }
        else{
            echo '<script>alert("Registration Failed!")</script>';
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Redirect to the homepage or desired location
    }
}
