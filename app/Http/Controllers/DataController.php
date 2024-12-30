<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booth;
use App\Models\Category;
use App\Models\Verification;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    public function storeEvent(Request $request)  
    {  
        $validatedData = $request->validate([  
            'name' => 'required|string|max:255',  
            'description' => 'required|string', 
            'category' => 'required|string|in:Education,Fashion & Beauty,Hobbies & Crafts,Music,Food & Drinks,Art & Culture,Tech & Start Up,Travel & Vacation', 
            'start_date' => 'required|date',  
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',  
            'venue' => 'required|string|max:255',
            'banner_photo' => 'nullable|file|mimes:jpeg,jpg,png,gif|max:2048'
        ]);  

        $data = new Event($validatedData);
        $data['user_id'] = Auth::id();

        // Save file as mediumblob  
        if ($request->hasFile('banner_photo')) {  
            $file = $request->file('banner_photo');  
            $data->banner_photo = file_get_contents($file);
        }  
  
        if ($data->save()) {  
            return redirect()->route('dashboard')->with('success', 'Event created successfully.');  
        } else {  
            return redirect()->back()->withErrors(['error' => 'Failed to create event.']);  
        } 
    }

    public function deleteEvent($event_name, $id)  
    {  
        $event = Event::findOrFail($id);  

        $event->delete();  
 
        return redirect()->route('events')->with('success', 'Delete event success.');  
    }

    public function storeBoothCat(Request $request, $event_name)  
    {  
        // Validasi data dari form  
        $validatedData = $request->validate([  
            'category_name' => 'required|string|max:255'
        ]); 

        $event = Event::where('name', $event_name)->first();  

        if (!$event) {  
            return response()->json(['message' => 'Event not found'], 404);  
        }  

        $data = new Category($validatedData);  
        $data->event_id = $event->id;

        if ($data->save()) {  
            return redirect()->route('mybooth', ['event_name' => $event_name])->with('success', 'Category created successfully.');  
        } else {  
            return redirect()->back()->withErrors(['error' => 'Failed to create category booth.']);  
        } 
    }

    public function storeBooth(Request $request, $event_name, $category_name)  
    {   
        $validatedData = $request->validate([  
            'booth_name' => 'required|string|max:255',  
            'booth_price' => 'required|numeric|between:0,999999999999.99',  
            'booth_description' => 'required|string|max:255',  
        ]);  

        $category = Category::where('category_name', $category_name)->first();  
        
        if (!$category) {  
            return redirect()->back()->withErrors(['category' => 'Kategori tidak ditemukan.']);  
        }  

        $data = new Booth($validatedData);
        $data->booth_category_id = $category->id;
        
        if ($data->save()) {  
            return redirect()->route('mybooth', ['event_name' => $event_name])->with('success', 'Booth created successfully.');  
        } else {  
            return redirect()->back()->withErrors(['error' => 'Failed to create booth.']);  
        }
    }

    public function deleteBooth($event_name, $category_name, $id)  
    {  
        $booth = Booth::findOrFail($id);  

        $category = $booth->category;  
 
        $eventName = $category ? $category->event->name : $event_name;  

        $booth->delete();  
 
        return redirect()->route('mybooth', ['event_name' => $eventName])->with('success', 'Delete booth success.');  
    }

    public function storeVerifProfile(Request $request)  
    {  
        $validatedData = $request->validate([  
            'id_num' => 'required|string|max:20',  
            'id_name' => 'required|string|max:255', 
            'id_address' => 'required|string|max:255',
            'id_photo' => 'required|file|mimes:jpeg,jpg,png|max:2048'
        ]);  

        $data = new Verification($validatedData);
        $data['user_id'] = Auth::id();

        // Save file as mediumblob
        if ($request->hasFile('id_photo')) {  
            $file = $request->file('id_photo');  
            $data->id_photo = file_get_contents($file);
        }  
  
        if ($data->save()) {  
            return redirect()->route('verif')->with('success', 'Verification added successfully.');  
        } else {  
            return redirect()->back()->withErrors(['error' => 'Failed to add verification.']);  
        }
    }
}
