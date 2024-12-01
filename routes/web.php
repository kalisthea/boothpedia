<?php

use Illuminate\Support\Facades\Route;

Route::get('/db', function () {
    return view('dbview');
});

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/eventsaya', function () {
    return view('myevents');
})->name('events');

Route::get('/informasidasar', function () {
    return view('myevents');
})->name('info');

Route::get('/verifikasiprofile', function () {
    return view('myevents');
})->name('verif');

Route::get('/rekening', function () {
    return view('account');
})->name('account');