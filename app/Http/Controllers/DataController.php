<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; 

class DataController extends Controller
{
    public function storeEvent(Request $request)  
    {  
        // Validasi data dari form  
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

        // Menyimpan file sebagai mediumblob  
        if ($request->hasFile('banner_photo')) {  
            $file = $request->file('banner_photo');  
            $data->banner_photo = file_get_contents($file); // Menyimpan konten file ke kolom banner_photo  
        }  
  
        if ($data->save()) {  
            return redirect()->route('dashboard')->with('success', 'Event created successfully.');  
        } else {  
            return redirect()->back()->withErrors(['error' => 'Failed to create event.']);  
        } 
    }

    public function storeBoothCat(Request $request, $event_name)  
    {  
        // Validasi data dari form  
        $validatedData = $request->validate([  
            'category_name' => 'required|string|max:255'
        ]); 
        
        // Mengambil ID event berdasarkan nama event  
        $event = Event::where('name', $event_name)->first();  

        // Pastikan event ditemukan  
        if (!$event) {  
            return response()->json(['message' => 'Event not found'], 404);  
        }  

        // Membuat instance Category  
        $data = new Category($validatedData);  
        $data->event_id = $event->id; // Set event_id dengan ID event yang ditemukan  

        if ($data->save()) {  
            return redirect()->route('mybooth', ['event_name' => $event_name])->with('success', 'Category created successfully.');  
        } else {  
            return redirect()->back()->withErrors(['error' => 'Failed to create event.']);  
        } 
    }
}
