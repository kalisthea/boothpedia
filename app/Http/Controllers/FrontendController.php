<?php

namespace App\Http\Controllers;

use App\Models\Booth;
use App\Models\Event;
use App\Models\Rating;
use App\Models\Refund;
use App\Models\Invoice;
use App\Models\Category;
use App\Models\BankAccount;
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

            return redirect()->route('bookedbooth.list')->with("success","Booking Success");
    
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
        $comment = $request->input('comment');

        $rate = new Rating();
        $rate->eo_id = $eo_id;
        $rate->tenant_id = $user_id;
        $rate->event_id = $event_id;
        $rate->rating = $rating;
        $rate->comment = $comment;

        
       
        if ($rate->save()) {
            return redirect()->back()->with('success', 'Successfully rated event organizer!'); 
        } else {
            return redirect()->back()->with('error', 'Failed to rate event organizer.');
        }
        
    }

    //To refund
    public function refund(Request $request){
        $user = Auth::user();
        $user_id = $user->id;

        $eo_id = $request->input('eo_id');
        $event_id = $request->input('event_id');
        $invoice_id = $request->input('invoice_id');
        

        $refund = new Refund();
        $refund->tenant_id = $user_id;
        $refund->eo_id = $eo_id;
        $refund->event_id = $event_id;
        $refund->invoice_id = $invoice_id;
        $refund->reason = $request->input('reason');
        $refund->additional = $request->input('additional');
        $refund->image = $request->input('image');
        $refund->bank = $request->input('bank');
        $refund->bank_number = $request->input('bank_number');
        $refund->account_name = $request->input('account_name');
        
        if ($refund->save()) {
            return redirect()->back()->with('success', 'Refund form submitted!'); 
        } else {
            return redirect()->back()->with('error', 'Failed to rate event organizer.');
        }
    }

    //Finish Rental
    public function finishRental(Request $request){
        $invoice_id = $request->input('invoice_id');

        $invoice = Invoice::where('id', $invoice_id)->firstOrFail(); 

        $invoice->finished = 'Y'; 
        if ($invoice->save()) {
            return redirect()->back()->with('success', 'Thank you! Rental Finished'); 
        } else {
            return redirect()->back()->with('error', 'Failed to rate event organizer.');
        }
    }

    // Display refunds
    public function displayRefunds(Request $request){
        $filter = $request->input('filter', 'pending'); 

        if ($filter === 'approved') {
            $refunds = Refund::where('status', 'approved')->get();
        } elseif ($filter === 'denied') {
            $refunds = Refund::where('status', 'denied')->get();
        } elseif ($filter === 'pending') { 
            $refunds = Refund::whereNull('status', null)->get(); 
        } else {
            $refunds = Refund::where(function ($query) {
                $query->whereIn('status', ['approved', 'denied'])
                      ->orWhereNull('status');
            })->get();        
        }

        $filter2 = $request->input('filter-2', 'all'); 
        $currentDate = Carbon::now();
        if ($filter === 'active') {
            $events = Event::whereDate('start_date', '<', $currentDate)->where('status', 'Active')->paginate(5);
        } elseif ($filter === 'inactive') {
            
            $events = Event::whereDate('start_date', '<', $currentDate)->where('status', 'Inactive')->paginate(5);
        } else {
            $events = Event::whereDate('start_date', '<', $currentDate)->paginate(5);
        }

        

        return view('adminview', compact('refunds','filter', 'events'));
    }

    public function approve(Request $request)
    {
        $refund_id = $request->input('refund_id');
        $user = Auth::user();
        $name = $user->name;

        $refund = Refund::where('id', $refund_id)->firstOrFail(); 

        $refund->status = 'approved';
        $refund->admin_name = $name;
        $refund->save();

        return redirect()->back()->with('success', 'Refund approved successfully!');
    }

    public function deny(Request $request)
    {
        $refund_id = $request->input('refund_id');
        $user = Auth::user();
        $name = $user->name;

        $refund = Refund::where('id', $refund_id)->firstOrFail(); 

        $refund->status = 'denied';
        $refund->admin_name = $name;
        $refund->save();

        return redirect()->back()->with('success', 'Refund denied successfully!');
    }

    public function undo(Request $request)
    {
        $refund_id = $request->input('refund_id');

        $refund = Refund::where('id', $refund_id)->firstOrFail(); 

        $refund->status = NULL;
        $refund->save();

        return redirect()->back()->with('success', 'Undo Successful!');
    }

    //Finance view
    public function financeView(Request $request, $event_name){
        $filter = $request->input('filter', 'all'); 

        
        if(Event::where('name', $event_name)->exists()){
            $events = Event::where('name', $event_name)->first();

            $event_id = $events->id;

            if ($filter === 'finished') {
                $user_id = $events->user->id;
        
                $banks = BankAccount::where('user_id', $user_id)->get();
                $invoices = Invoice::where('event_id', $event_id)->where('finished', 'Y')->paginate(5);;
    
            } elseif ($filter === 'notfinished') {
                $user_id = $events->user->id;
        
                $banks = BankAccount::where('user_id', $user_id)->get();
                $invoices = Invoice::where('event_id', $event_id)->where('finished', 'N')->paginate(5);;
    
            } else {
               
    
                $invoices = Invoice::where('event_id', $event_id)->paginate(5);;
        
                $user_id = $events->user->id;
        
                $banks = BankAccount::where('user_id', $user_id)->get();
        
            }
            
        }
        else{
            return redirect('/')->with('status',"Event does not exists");
        }

        

      
        return view('financeview', compact('events', 'invoices', 'banks', 'filter'));
    }

    public function changeStatus(Request $request)
    {
        $event_id = $request->input('event_id');

        $event = Event::where('id', $event_id)->firstOrFail(); 

        $event->status = 'Inactive';
        $event->save();

        return redirect()->back()->with('success', 'Event Inactivated!');
    }

    public function undoStatus(Request $request)
    {
        $event_id = $request->input('event_id');

        $event = Event::where('id', $event_id)->firstOrFail(); 

        $event->status = 'Active';
        $event->save();

        return redirect()->back()->with('success', 'Undo Successful!');
    }

    //Display refunds for finance
    public function financeRefund(Request $request){
        $filter = $request->input('filter', 'all'); 

        if ($filter === 'approved') {
            $refunds = Refund::where('status', 'approved')->get();
        } 
        elseif ($filter === 'finished') {
            $refunds = Refund::where('status', 'finished')->get();
        }
        else{
            $refunds = Refund::whereIn('status', ['approved', 'finished'])->get();
        }

        return view ('financerefunds', compact('refunds', 'filter'));
    }

    //Change refund status for finance
    public function refundStatus(Request $request){
        $user = Auth::user();
        $name = $user->name;

        $refund_id = $request->input('refund_id');

        $refund = Refund::where('id', $refund_id)->firstOrFail(); 

        $refund->status = 'finished';
        $refund->admin_name = $name;
        $refund->save();

        return redirect()->back()->with('success', 'Refund approved successfully!');
    }

    public function undoRefund(Request $request){
        $user = Auth::user();
        $name = $user->name;
        $refund_id = $request->input('refund_id');

        $refund = Refund::where('id', $refund_id)->firstOrFail(); 

        $refund->status = 'approved';
        $refund->admin_name = $name;
        $refund->save();

        return redirect()->back()->with('success', 'Undo Successful!');
    }


    public function displayDashboard()  
    {  
        $user = Auth::user();  
        $userId = $user->id;  

        $allEvents = Event::where('user_id', $userId)->get();  

        $activeEvents = Event::where('user_id', $userId)  
                            ->where('end_date', '>', today())  
                            ->get();  

        $pastEvents = Event::where('user_id', $userId)  
                        ->where('end_date', '<', today())  
                        ->get();  

        $totalActiveEvents = $activeEvents->count();  
        $totalPastEvents = $pastEvents->count();  

        $averageRating = Rating::whereIn('event_id', $allEvents->pluck('id'))  
                                ->avg('rating');

        $totalActiveBooths = Booth::whereIn('booth_category_id', $activeEvents->flatMap->categories->pluck('id'))  
                                ->count();  

        $totalSales = Invoice::whereIn('event_id', $allEvents->pluck('id'))  
                            ->sum('total_price');

        $totalBoothsSold = Invoice::whereIn('event_id', $allEvents->pluck('id'))  
                                ->sum('quantity');

        return view('dashboard', compact(  
            'totalActiveEvents',  
            'totalPastEvents',  
            'averageRating',  
            'totalActiveBooths',  
            'totalSales',  
            'totalBoothsSold'  
        ));  
    }

    //Display event on event organizer page
    public function displayEvents()  
    {  
        $user = Auth::user();
  
        if (!$user) {  
            return redirect('/login-eo');
        }  

        $userId = $user->id;

        $events = Event::where('user_id', $userId)
                    ->where('end_date', '>', today())
                    ->get();

        $pastEvents = Event::where('user_id', $userId)  
                       ->where('end_date', '<', today())
                       ->get();

        return view('myevents', compact('events', 'pastEvents'));
    }

    //Display event detail on event organizer page
    public function showEventDetail($event_name)  
    {   
        $event = Event::where('name', $event_name)->first();  

        if ($event) {  

            return view('myevents-detail', compact('event'));  
        } else {  
            return redirect('/myevents')->with('status', "Event does not exist");  
        }  
    }

    public function editEvent($event_name, $id)
    {
        $event = Event::findOrFail(($id));
        return view('editevent', compact('event'));
    }

    //Display proposal on other tab
    public function showProposal($event_name)  
    {   
        $event = Event::where('name', $event_name)->first();
        
        $file = $event->proposal_doc;

        return response($file, 200)  
            ->header('Content-Type', 'application/pdf') 
            ->header('Content-Disposition', 'inline; filename="proposal_event.pdf"'); 
    }

    // Display all booths in the event
    public function showBoothPage(Request $request, $event_name)  
    {  
        $event = Event::where('name', $event_name)->first();  
    
        if (!$event) {   
            return redirect('/myevents')->with('status', "Event does not exist");
        }

        $layoutPhoto = $event->layout_photo ? base64_encode($event->layout_photo) : null;

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

        $occupiedBooths = Booth::where('is_occupied', 'Y')
            ->whereIn('booth_category_id', $event->categories->pluck('id'))  
            ->count();

        return view('booth', compact('event','layoutPhoto', 'boothCategories', 'booths', 'selectedCategory', 'occupiedBooths'));
    }

    // Display Verification Profile data
    public function displayVerifProfile()  
    {  
        $user = Auth::user();

        $userId = $user->id;

        $verifProfile = Verification::where('user_id', $userId)->first();  

        return view('verification', compact('verifProfile'));
    }

    public function editVerifProfile($id)
    {
        $profile = Verification::findOrFail(($id));
        return view('editverifprofile', compact('profile'));
    }

    // Display Bank Account data
    public function displayBankAccount()  
    {  
        $user = Auth::user();

        $userId = $user->id;

        $bankAccount = BankAccount::where('user_id', $userId)->first();  

        return view('account', compact('bankAccount'));
    }

    public function editBankAccount($id)
    {
        $bankAcc = BankAccount::findOrFail(($id));
        return view('editbankaccount', compact('bankAcc'));
    }

    public function showInvoice(Request $request) {  

        $categories = Category::all();  
        $events = Event::all();
    
        $query = Invoice::with(['tenant', 'event', 'booths.category']);  
        
        // Filter by event name
        if ($request->filled('event_name')) {  
            $query->where('event_id', $request->event_name);
        }  
    
        // Filter by month
        if ($request->filled('month')) {  
            $query->whereMonth('created_at', $request->month);  
        }  
    
        // Filter by category
        if ($request->filled('category')) {  
            $query->whereHas('booths.category', function ($q) use ($request) {  
                $q->where('id', $request->category);  
            });  
        }  
    
        $invoices = $query->get();  
    
        $totalQty = $invoices->sum('quantity');  
        $totalSales = $invoices->sum('total_price');  
    
        return view('bookinginvoices', compact('invoices', 'totalQty', 'totalSales', 'categories', 'events'));  
    }

    public function showRatings(Request $request) {
        $eoId = Auth::id();

        $query = Rating::with(['tenant', 'event'])->where('eo_id', $eoId);  

        if ($request->has('rating') && $request->rating) {  
            $query->where('rating', $request->rating);  
        }  

        $ratings = $query->get();

        $averageRating = Rating::where('eo_id', $eoId)->avg('rating');

        return view('ratingeo', compact('ratings', 'averageRating'));
    }

}
