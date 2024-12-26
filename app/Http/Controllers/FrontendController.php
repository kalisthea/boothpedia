<?php

namespace App\Http\Controllers;

use App\Models\Booth;
use App\Models\Event;
use App\Models\Invoice;
use App\Models\Category;
use Illuminate\Http\Request;
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



    //Display booths
    public function showBooths(Request $request, $event_name)  
    {  
        // Cek apakah event dengan nama yang diberikan ada  
        if(Event::where('name', $event_name)->exists()){
            $events = Event::where('name', $event_name)->first();

            
            $events->image_base64 = base64_encode($events->banner_photo);
            
        }
        else{
            return redirect('/')->with('status',"Event does not exists");
        }
        // Ambil booth categories
        $boothCategories = $events->categories;

        // Ambil booth berdasarkan kategori jika ada
        $booths = [];
        $selectedCategory = null;

        if ($request->has('category_name')) {
            $selectedCategory = $request->input('category_name');
            $category = $events->categories()->where('id', $selectedCategory)->first();

            if ($category) {
                $booths = Booth::where('booth_category_id', $category->id)->get();
            }
        }
        return view('eventbooth', compact('events', 'boothCategories', 'booths', 'selectedCategory'));
    }


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
            $request->session()->put('selectedBooths', $selectedBoothIds); 

            $selectedBooths = Booth::whereIn('id', $selectedBoothIds)->get(); 

            $eventName = $request->input('event_name');
            if(Event::where('name', $eventName)->exists()){
                $events = Event::where('name', $eventName)->first();
    
                
                $events->image_base64 = base64_encode($events->banner_photo);
            }
            else{
                return redirect('/')->with('status',"Event does not exists");
            }

            return view('booking', [
                'selectedBooth' => $selectedBooths ,
                'event' => $events
            ]); 
    
            // return redirect()->route('booking.view', ['event_name' => $eventName])->with([
            //     'selectedBooths' => $selectedBoothIds,
    
            // ]);
    
    
        }

    //Save booking detail
    public function bookedData(Request $request, $event_name){
        if (!Event::where('name', $event_name)->exists()) {
            return redirect('/')->with('status', "Event does not exist");
        }
    
        $events = Event::where('name', $event_name)->first();
        $events->image_base64 = base64_encode($events->banner_photo);

        $user = Auth::user();
        $user_id = $user->id;
        $method =  $request->input('payment_method');

   
        $boothIds= $request->input('booth_id',[]);
        $boothPrices = $request->input('booth_price',[]);
        if ($request->has('payment_confirmed') && $request->input('payment_confirmed') === 'true') { 
            foreach ($boothIds as $index => $boothId) { 
                $boothPrice = $boothPrices[$index]; // 
    
                    $invoice = new Invoice(); 
                    $invoice->tenant_id = $user_id;
                    $invoice->event_id = $events->id;
                    $invoice->booth_id = $boothId; 
                    $invoice->payment_method = $method; 
                    $invoice->price = $boothPrice; 
                    $invoice->total_price = $boothPrice + 25000; 
                    $invoice->save(); 
            }

            session()->forget('selectedBooths'); 

            return redirect()->route('bookedbooth.list');
    
        }
        
       
    }

    //To display booked view
    public function bookedView($event_name){
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
    public function showBoothPage(Request $request, $event_name)  
    {  
        // Cek apakah event dengan nama yang diberikan ada  
        $event = Event::where('name', $event_name)->first();  
    
        if (!$event) {   
            // Jika event tidak ditemukan, redirect dengan pesan  
            return redirect('/eventsaya')->with('status', "Event does not exist");
        }

        // Ambil booth categories
        $boothCategories = $event->categories;

        // Ambil booth berdasarkan kategori jika ada
        $booths = [];
        $selectedCategory = null;

        if ($request->has('category_name')) {
            $selectedCategory = $request->input('category_name');
            $category = $event->categories()->where('id', $selectedCategory)->first();

            if ($category) {
                $booths = Booth::where('booth_category_id', $category->id)->get();
            }
        }
        return view('booth', compact('event', 'boothCategories', 'booths', 'selectedCategory'));
    }

    // public function showBooth($event_name, $category_name)  
    // {  
    //     // Cek apakah event dengan nama yang diberikan ada  
    //     $event = Event::where('name', $event_name)->first();  

    //     if (!$event) {  
    //         return redirect('/eventsaya')->with('status', "Event tidak ditemukan");  
    //     }  
        
    //     // Cek apakah kategori dengan nama yang diberikan ada  
    //     $category = $event->categories()->where('name', $category_name)->first();  
        
    //     if (!$category) {  
    //         return redirect('/eventsaya')->with('status', "Kategori tidak ditemukan untuk event ini");  
    //     }  

    //     // Ambil booth terkait  
    //     $booths = $category->booths()->get(); // Mengasumsikan ada relasi booths di model Category  
        
    //     // Kembalikan tampilan dengan data booth  
    //     return view('booth.show', compact('event', 'category', 'booths'));  
    // }

}
