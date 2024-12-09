<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

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
   
}
