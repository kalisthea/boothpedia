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

   //Display event on event organizer page
   public function displayEvents()  
    {  
        $eo = Auth::guard('eventorganizers')->user();
        $eo_id = $eo ? $eo->id : null;
  
        if (!$eo) {  
            return redirect('/login-eo');
        }  

        $events = Event::where('eo_id', $eo_id)->get();  

        return view('myevents', compact('events'));
    }

    //Display event detail on event organizer page
    public function showEventDetail($event_name)  
    {   
        // Pastikan event organizer adalah pengguna yang terautentikasi  
        $eo = Auth::guard('eventorganizers')->user();   

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
