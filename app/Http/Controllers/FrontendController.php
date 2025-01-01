<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Booth;
use App\Models\Event;
use App\Models\Rating;
use App\Models\Invoice;
use App\Models\Category;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{

    //To display on explore page based on category

   public function viewCategoryBased(){
        $currentDate = Carbon::now(); 
        $categories = Event::distinct()->pluck('category'); 
        $events = Event::whereDate('start_date', '>', $currentDate)->get();

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
        if(Event::where('name', $event_name)->exists()){
            $events = Event::where('name', $event_name)->first();

            
            $events->image_base64 = base64_encode($events->banner_photo);
            
        }
        else{
            return redirect('/')->with('status',"Event does not exists");
        }

        $boothCategories = $events->categories;

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
            // foreach ($boothIds as $index => $boothId) { 
            //     $boothPrice = $boothPrices[$index]; // 
    
            //         $invoice = new Invoice(); 
            //         $invoice->tenant_id = $user_id;
            //         $invoice->event_id = $events->id;
            //         $invoice->booth_id = $boothId; 
            //         $invoice->payment_method = $method; 
            //         $invoice->price = $boothPrice; 
            //         $invoice->total_price = $boothPrice + 25000; 
            //         $invoice->save(); 
            // }

            $invoice = new Invoice(); 
            $invoice->tenant_id = $user_id;
            $invoice->event_id = $events->id;
            $invoice->payment_method = $method; 
            
            
            $totalPrice = 0;
            $qty = 0;

            foreach($boothIds as $index => $boothId){
                $boothPrice = $boothPrices[$index];
                $totalPrice += $boothPrice;
                $qty++;
            }

            $invoice->quantity = $qty;
            $invoice->price = $totalPrice; 
            $invoice->total_price = $totalPrice + 25000; 
            $invoice->save(); 

            foreach($boothIds as $boothId) {
                $invoice->booths()->attach($boothId); // Attach booth IDs to the invoice

                   // Find the booth by ID
                $booth = Booth::find($boothId);

                // Update the booth's is_occupied status
                if ($booth) { 
                    $booth->is_occupied = 'Y'; 
                    $booth->save(); 
                }
            }
    

            session()->forget('selectedBooths'); 

            return redirect()->route('bookedbooth.list');
    
        }
        
       
    }

    //Display booked booths

    public function bookedView(){
        $user = Auth::user();
        $user_id = $user->id;
        if (!Invoice::where('tenant_id', $user_id)->exists()) {
            echo "<script type='text/javascript'>
            alert('You currently have no booths booked!');
            window.location.href='/home';
            </script>";
        }

        $today = Carbon::now();
        
        $invoices = Invoice::where('tenant_id', $user_id)
                        ->with('event') 
                        ->whereHas('event', function ($query) use ($today) {
                            $query->whereDate('end_date', '>=', $today); 
                        })
                        ->get();

        
        
        $pastinvoices = Invoice::where('tenant_id', $user_id)
                        ->with('event') 
                        ->whereHas('event', function ($query) use ($today) {
                            $query->whereDate('end_date', '<', $today); 
                        })
                        ->get();

        return view('boothlist', compact('invoices', 'pastinvoices'));
    }

    // Display booking detail
    public function bookingDetail($event_name){
        $user = Auth::user();
        $user_id = $user->id;

        if(Event::where('name', $event_name)->exists()){
            $events = Event::where('name', $event_name)->first();

            
            $events->image_base64 = base64_encode($events->banner_photo);
            
        }
        else{
            return redirect('/home')->with('status',"Event does not exists");
        }

        $invoices = Invoice::where('tenant_id', $user_id)->where('event_id', $events->id)->get();

        return view('bookingdetail', compact('events', 'invoices'));
    }

    // To give rating 
    public function giveRating(Request $request){
        $user = Auth::user();
        $user_id = $user->id;

        $eo_id = $request->input('eo_id');
        $event_id = $request->input('event_id');
        $rating = $request->input('rating');

        $rate = new Rating();
        $rate->eo_id = $eo_id;
        $rate->tenant_id = $user_id;
        $rate->event_id = $event_id;
        $rate->rating = $rating;

        
       
        if ($rate->save()) {
            return redirect()->back()->with('success', 'Successfully rated event organizer!'); 
        } else {
            return redirect()->back()->with('error', 'Failed to rate event organizer.');
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
        $event = Event::where('name', $event_name)->first();  

        if ($event) {  

            return view('myevents-detail', compact('event'));  
        } else {  
            return redirect('/eventsaya')->with('status', "Event does not exist");  
        }  
    } 

    // Display all booths in the event
    public function showBoothPage(Request $request, $event_name)  
    {  
        $event = Event::where('name', $event_name)->first();  
    
        if (!$event) {   
            return redirect('/eventsaya')->with('status', "Event does not exist");
        }

        $boothCategories = $event->categories;

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

    // Display Verification Profile data
    public function displayVerifProfile()  
    {  
        $user = Auth::user();

        $userId = $user->id;

        $verifProfile = Verification::where('user_id', $userId)->first();  

        return view('verification', compact('verifProfile'));
    }

    // Display Bank Account data
    public function displayBankAccount()  
    {  
        $user = Auth::user();

        $userId = $user->id;

        $bankAccount = BankAccount::where('user_id', $userId)->first();  

        return view('account', compact('bankAccount'));
    }

}
