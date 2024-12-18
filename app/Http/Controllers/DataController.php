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

        // Menyimpan file sebagai mediumblob  
        if ($request->hasFile('banner_photo')) {  
            $file = $request->file('banner_photo');  
            $data->banner_photo = file_get_contents($file); // Menyimpan konten file ke kolom banner_photo  
        }  

        
        $data->eo()->associate(Auth::guard('eventorganizers')->user());  
        if ($data->save()) {  
            return redirect()->route('dashboard')->with('success', 'Event created successfully.');  
        } else {  
            return redirect()->back()->withErrors(['error' => 'Failed to create event.']);  
        } 
            // Auth::guard('eventorganizers')->user();
            // $data = new Event($validatedData);
            // $data->name = $request->name;
            // $data->description = $request->description;
            // $data->category = $request->category;
            // $data->location = $request->location;
            // $data->start_date = $request->start_date;

            // $data->eo()->associate(Auth::guard('eventorganizers')->user());
            // $data->save();
            // dd(auth()->user(), $data);


            // return redirect()->route('dashboard')->with('success','yey sukses');
            // if ($data->save()){
            //     echo "<script type='text/javascript'>
            //     alert('Registration Successful!');
            //     window.location.href='/dashboard';
            //     </script>";
            // }
            // else{
            //     echo '<script>alert("Registration Failed!")</script>';
            // }

        // try {
        //     // Ambil ID pengguna dari guard 'eventorganizers'
        //     // $eo_id = Auth::guard('eventorganizers')->id();
        //     // if (!$eo_id) {
        //     //     return response()->json(['error' => 'Unauthorized'], 401);
        //     // }

        //     // Mengambil data dari request dan menambahkan status
        //     Auth::guard('eventorganizers')->user();
        //     $data = new Event($validatedData);
        //     $data->eo()->associate(auth()->user()); // Associate the data with the authenticated user
        //     // $data = $request->except('banner_photo');  
        //     // $data['status'] = 'active';
        //     // $data['eo_id'] = $eo_id;

        //     // Menyimpan data event ke database  
        //     // $event = Event::create($data);  

        //     // Jika ada foto banner
        //     // if ($request->hasFile('banner_photo')) {  
        //     //     $path = $request->file('banner_photo')->store('banners', 'public');  
        //     //     $data->banner_photo = $path;  
        //     // } 

        //     if ($data->save()){
        //         echo "<script type='text/javascript'>
        //         alert('Registration Successful!');
        //         window.location.href='/dashboard';
        //         </script>";
        //     }
        //     else{
        //         echo '<script>alert("Registration Failed!")</script>';
        //     }
        // } catch (\Exception $e) {  
        //     return response()->json(['error' => 'Failed to create event: ' . $e->getMessage()], 500);  
        // }
    }

    public function storeBoothCat(Request $request)  
    {  
        // Validasi data dari form  
        $validatedData = $request->validate([  
            'category_name' => 'required|string|max:255'
        ]); 
        
        $data = new Category($validatedData);
        
        $data->eo()->associate(Auth::guard('eventorganizers')->user());  
        if ($data->save()) {  
            return redirect()->route('dashboard')->with('success', 'Event created successfully.');  
        } else {  
            return redirect()->back()->withErrors(['error' => 'Failed to create event.']);  
        } 

        // try {
        //     // Ambil ID pengguna dari guard 'eventorganizers'
        //     $eo_id = Auth::guard('eventorganizers')->id();
        //     if (!$eo_id) {
        //         return response()->json(['error' => 'Unauthorized'], 401);
        //     }

        //     // Mengambil data dari request dan menambahkan status  
        //     $data = $request->except('banner_photo');  
        //     $data['status'] = 'active';
        //     $data['eo_id'] = $eo_id;

        //     // Menyimpan data event ke database  
        //     $event = Event::create($data);  

        //     // Jika ada foto banner
        //     if ($request->hasFile('banner_photo')) {  
        //         $path = $request->file('banner_photo')->store('banners', 'public');  
        //         $event->banner_photo = $path;  
        //         $event->save();  
        //     } 

        //     return response()->json(['success' => 'Event created successfully', 'event' => $event]);  
        // } catch (\Exception $e) {  
        //     return response()->json(['error' => 'Failed to create event: ' . $e->getMessage()], 500);  
        // }
    }
}
