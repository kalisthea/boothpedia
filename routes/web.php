<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/explore', function () {
    return view('explore');
});

Route::get('/signin', function () {
    return view('signin');
});

Route::get('/signin-number', function () {
    return view('signinnumber');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/login-number', function () {
    return view('loginnumber');
});

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

