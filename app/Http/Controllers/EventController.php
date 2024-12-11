<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Event;


class EventController extends Controller
{
   
    function list(){

        $eventData = Event::all();
        foreach ($eventData as $item) {
            $item->image_base64 = base64_encode($item->banner_photo);
        }
        return view('index', compact('eventData'));
        // $eventData = Event::all();
        // return view('index', ['events'=>$eventData]);
    }

    function listForHome(){

        $eventData = Event::all();
        foreach ($eventData as $item) {
            $item->image_base64 = base64_encode($item->banner_photo);
        }
        return view('home', compact('eventData'));
        // $eventData = Event::all();
        // return view('index', ['events'=>$eventData]);
    }

  
}
