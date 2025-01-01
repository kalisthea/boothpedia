<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class EventController extends Controller
{
   
    function list(){

        $currentDate = Carbon::now();

        $eventData = Event::whereDate('start_date', '>=', $currentDate)->get();
        foreach ($eventData as $item) {
            $item->image_base64 = base64_encode($item->banner_photo);
        }
        return view('index', compact('eventData'));
        // $eventData = Event::all();
        // return view('index', ['events'=>$eventData]);
    }

    function listForHome(){

       $currentDate = Carbon::now();

        $eventData = Event::whereDate('start_date', '>=', $currentDate)->get();
        foreach ($eventData as $item) {
            $item->image_base64 = base64_encode($item->banner_photo);
        }
        return view('home', compact('eventData'));
        // $eventData = Event::all();
        // return view('index', ['events'=>$eventData]);
    }

    function createevent(){
        return view("createevent");
    }

  
}
