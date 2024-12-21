<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Booth;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{

    //To display on explore page based on category

   public function viewCategoryBased(){
    $categories = Event::distinct()->pluck('category');
    $events = Event::all();

    foreach ($events as $item) {
        $item->image_base64 = base64_encode($item->banner_photo);
    }

    return view('explore', compact('categories', 'events'));
   }

    //To Display Clicked Events (Description view)

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

    //To Display Clicked Events (Booth view)
   public function eventdetailbooth($event_name){
        if(Event::where('name', $event_name)->exists()){
            $events = Event::where('name', $event_name)->first();

            
            $events->image_base64 = base64_encode($events->banner_photo);
            
            $boothCategories = $events->categories;  

        
            return view('eventbooth', compact('events', 'boothCategories'));
        }
        else{
            return redirect('/')->with('status',"Event does not exists");
        }
    }

    // public function storeBoothSelection(Request $request){
    //     $selectedBoothIds = $request->input('selected_booth_ids'); 
    //     Session::put('selectedBoothIds', $selectedBoothIds); 

    //     // ... your existing logic to handle the selected booth IDs ...

    //     return redirect()->back(); // Redirect back to the same page
    // }


//    To display on booking page
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



    //To proceed to booking
    public function chosenBooth(Request $request){

        $selectedBoothIds = request()->input('selected_booth_ids');
        $selectedBooths = Booth::whereIn('id', $selectedBoothIds)->get(); 
        $eventName = $request->input('event_name'); 


        return redirect()->route('booking.view', ['event_name' => $eventName])->with([
            'selectedBooths' => $selectedBooths,

        ]);


    }

   //Display event on event organizer page
   public function displayEvents()  
    {  
        $user = Auth::user();
  
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

    // Display all booths in the event
    public function showBooth($event_name)  
    {  
        // Cek apakah event dengan nama yang diberikan ada  
        $event = Event::where('name', $event_name)->first();  
    
        if ($event) {  
            // Ambil booth yang terkait dengan event ini  
            $boothCategories = $event->categories;  
            return view('booth', compact('event', 'boothCategories'));  
        } else {  
            // Jika event tidak ditemukan, redirect dengan pesan  
            return redirect('/eventsaya')->with('status', "Event does not exist");  
        }   
    }
}
