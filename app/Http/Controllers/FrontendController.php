<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{

    //To Display Clicked Events

    public function eventdetail($event_name){
        if(Event::where('name', $event_name)->exists()){
            $events = Event::where('name', $event_name)->first();

            
            $events->image_base64 = base64_encode($events->banner_photo);
            
        
            return view('eventdetail', compact('events'));
        }
        else{
            return redirect('/')->with('status',"Event does not exists");
        }
   }

   //To display on explore page based on category

   public function viewCategoryBased(){
    $categories = Event::distinct()->pluck('category');
    $events = Event::all();

    foreach ($events as $item) {
        $item->image_base64 = base64_encode($item->banner_photo);
    }

    return view('explore', compact('categories', 'events'));
   }

   // To display on booking page

   public function viewBooking($event_name){
    if(Event::where('name', $event_name)->exists()){
        $events = Event::where('name', $event_name)->first();

        
        $events->image_base64 = base64_encode($events->banner_photo);
        
    
        return view('booking', compact('events'));
    }
    else{
        return redirect('/')->with('status',"Event does not exists");
    }
}

   //Display event on event organizer page
   public function displayEvents()  
    {  
        $user = auth()->user();
  
        if (!$user) {  
            return redirect('/login-eo');
        }  

        $userId = $user->id;

        $events = Event::where('user_id', $userId)->get();  

        return view('myevents', compact('events'));
    }

    //Display event detail on event organizer page
    public function showEventDetail($event_name)  
    {   
        // Cek apakah event dengan nama yang diberikan ada  
        $event = Event::where('name', $event_name)->first();  

        if ($event) {  
            // Tampilkan view detail event  
            return view('myevents-detail', compact('event'));  
        } else {  
            // Jika event tidak ditemukan, redirect dengan pesan  
            return redirect('/eventsaya')->with('status', "Event does not exist");  
        }  
    } 
   
}
