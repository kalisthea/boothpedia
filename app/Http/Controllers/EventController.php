<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Event;


class EventController extends Controller
{
   
    function list(){

        $eventData = Event::all();
        // return view('index', compact('events'));
        // $eventData = Event::all();
        return view('index', ['events'=>$eventData]);
    }
}
