<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class FrontendController extends Controller
{
    public function eventdetail($event_name){
        if(Event::where('name', $event_name)->exists()){
            $events = Event::where('name', $event_name)->first();
            return view('eventdetail', compact('events'));
        }
        else{
            return redirect('/')->with('status',"Event does not exists");
        }
   }
}
