<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    public function storeEvent(Request $request)  
    {  
        // Validasi data dari form  
        $request->validate([  
            'name' => 'required|string|max:255',  
            'description' => 'required|string', 
            'category' => 'required|string', 
            'start_date' => 'required|date',  
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',  
            'banner_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);  

        try {
            // Ambil ID pengguna dari guard 'eventorganizers'
            $eo_id = Auth::guard('eventorganizers')->id();
            if (!$eo_id) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Mengambil data dari request dan menambahkan status  
            $data = $request->except('banner_photo');  
            $data['status'] = 'active';
            $data['eo_id'] = $eo_id;

            // Menyimpan data event ke database  
            $event = Event::create($data);  

            // Jika ada foto banner
            if ($request->hasFile('banner_photo')) {  
                $path = $request->file('banner_photo')->store('banners', 'public');  
                $event->banner_photo = $path;  
                $event->save();  
            } 

            return response()->json(['success' => 'Event created successfully', 'event' => $event]);  
        } catch (\Exception $e) {  
            return response()->json(['error' => 'Failed to create event: ' . $e->getMessage()], 500);  
        }
    }
}
