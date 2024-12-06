<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/db', function () {
    return view('dbview');
});

Route::get('/', function () {
    return view('home');
});

Route::get('/explore', function () {
    return view('explore');
});

Route::get('/booth', function () {
    return view('boothlist');
});

Route::get('/booth-rate', function () {
    return view('rateview');
});


Route::middleware("auth")->group(function (){
    Route::view('/home', 'index')->name("home");
});


Route::get('/login', [AuthController::class,"login"])
    ->name("login");

Route::post('/login', [AuthController::class,"loginPost"])
    ->name("login.post");

Route::get('/login-number', [AuthController::class,"loginnum"])
    ->name("loginnum");

Route::post('/login-number', [AuthController::class,"loginnumPost"])
    ->name("loginnum.post");

Route::get('/signup', [AuthController::class,"signup"])
    ->name("signup");

Route::post('/signup', [AuthController::class,"signupPost"])
    ->name("signup.post");

Route::get('/event-detail-desc', function () {
    return view('eventdetail');
});

Route::get('/event-detail-booth', function () {
    return view('eventbooth');
});

Route::get('/booking', function () {
    return view('booking');
});

Route::get('/bookingdetail', function () {
    return view('bookingdetail');
});

Route::get('/profile', function () {
    return view('userprofile');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/eventsaya', function () {
    return view('myevents');
})->name('events');

Route::get('/informasidasar', function () {
    return view('basicinfo');
})->name('info');

Route::get('/verifikasiprofile', function () {
    return view('myevents');
})->name('verif');

Route::get('/rekening', function () {
    return view('account');
})->name('account');

Route::get('/buatevent', function () {  
    return view('createevent');  
})->name('buatevent');  

Route::get('/ubahbasicinfo', function () {  
    return view('editbasicinfo');  
})->name('editinfo');  