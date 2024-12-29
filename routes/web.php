<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\EventController;
use function Pest\Laravel\withMiddleware;


use App\Http\Controllers\MessageController;
use App\Http\Controllers\FrontendController;

Route::get('/db', function () {
    return view('dbview');
});

Route::get('/', function () {
    return view('home');
});

Route::get('/explore', function () {
    return view('explore');
});

Route::get('/explore', [FrontendController::class, 'viewCategoryBased']);



Route::get('/booth-rate', function () {
    return view('rateview');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::get('/home', [EventController::class, 'list'], function () {
    return view('index');
})->middleware('auth')->name('home');


// REGISTER AND LOGIN FOR TENANT

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


// REGISTER AND LOGIN FOR EO

Route::get('/login-eo', [AuthController::class,"loginEO"])
    ->name("loginEO");

Route::post('/login-eo', [AuthController::class,"loginEOPost"])
    ->name("loginEO.post");

Route::get('/login-number-eo', [AuthController::class,"loginnumEO"])
    ->name("loginnumEO");

Route::post('/login-number-eo', [AuthController::class,"loginnumEOPost"])
    ->name("loginnumEO.post");

Route::get('/signup-eo', [AuthController::class,"signupEO"])
    ->name("signupEO");

Route::post('/signup-eo', [AuthController::class,"signupEOPost"])
    ->name("signupEO.post");


//GET EVENTS
Route::get('/', [EventController::class, 'listForHome']);

//EVENT DETAILS
Route::get('event-detail-desc/{event_name}', [FrontendController::class, 'eventdetail']);
Route::get('event-detail-booth/{event_name}', [FrontendController::class, 'showBooths']);
Route::post('event-detail-booth/{event_name}', [FrontendController::class, 'chosenBooth'])->name('store.data');


//BOOKING EVENT
Route::get('booking/{event_name}', [FrontendController::class, 'viewBooking', 'chosenBooth'])
    ->middleware('auth')->name("booking.view");
Route::post('booking/{event_name}', [FrontendController::class, 'bookedData'])->name('booked.data');

// Show booked booth list
Route::get('booth/', [FrontendController::class, 'bookedView'])
    ->middleware('auth')->name("bookedbooth.list");


// Booking detail
Route::get('booking-detail/{event_name}', [FrontendController::class, 'bookingDetail']);

// Rating
Route::post('booth/', [FrontendController::class, 'giveRating'])
    ->middleware('auth')->name("rate.eo");

// POST EVENTS
Route::post('/buatevent', [DataController::class, 'storeEvent'])
    ->name('events.store');  

Route::get('/event-detail-booth', function () {
    return view('eventbooth');
});

Route::get('/booking', function () {
    return view('booking');
});

Route::get('/profile', function () {
    return view('userprofile');
})->middleware('auth');





Route::middleware("auth")->group(function (){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/eventsaya', [FrontendController::class, 'displayEvents'])->name('events');

    Route::get('/informasidasar', function () {
        return view('basicinfo');
    })->name('info');

    Route::get('/verifikasiprofile', function () {
        return view('myevents');
    })->name('verif');

    Route::get('/rekening', function () {
        return view('account');
    })->name('account');

    Route::get('/buatevent', [EventController::class,"createevent"])
    ->name("buatevent");  

    Route::get('/ubahbasicinfo', function () {  
        return view('editbasicinfo');  
    })->name('editinfo');  

    Route::get('detailevent/{event_name}', [FrontendController::class, 'showEventDetail']);  

    Route::get('/boothsaya/{event_name}', [FrontendController::class, 'showBoothPage'])
        ->name('mybooth');  
    
    Route::post('/boothsaya/{event_name}/categories', [DataController::class, 'storeBoothCat'])
        ->name('booth.categories.store');
    
    Route::post('/boothsaya/{event_name}/{category_name}', [DataController::class, 'storeBooth'])
        ->name('booth.store');
});





// CHAT MESSAGE

Route::get('/chatmessage', function () {  
    return view('cmtenant');  
})->name("chat.tenant"); 

Route::get('/chatmessage', [MessageController::class, "showStartedChats"], function (){   
});

Route::POST('/chatmessage', [MessageController::class, "searchEO"])->name("user.search");


Route::get('chatmessage-active/{chat_id}', [MessageController::class, 'sendMessage', 'getMessages']);
   
Route::post('chatmessage-active/{chat_id}', [MessageController::class,"sendMessage"])
    ->name("message.post");

// Route::get('chatmessage-active/{chat_id}', [MessageController::class, 'getMessages']);
