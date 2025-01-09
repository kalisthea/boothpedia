<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
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
            'banner_photo' => 'nullable|file|mimes:jpeg,jpg,png,gif|max:2048',
            'proposal_doc' => 'nullable|file|mimes:pdf,ppt,pptx,docx|max:5120'
        ]);  

        $data = new Event($validatedData);
        $data['user_id'] = Auth::id();

        // Save banner as mediumblob  
        if ($request->hasFile('banner_photo')) {  
            $file = $request->file('banner_photo');  
            $data->banner_photo = file_get_contents($file);
        }
        
        // Save proposal as mediumblob  
        if ($request->hasFile('proposal_doc')) {  
            $file = $request->file('proposal_doc');  
            $data->proposal_doc = file_get_contents($file);
        }
  
        if ($data->save()) {
            $event_name = $data['name'];
            return redirect()->route('mybooth', ['event_name' => $event_name])->with('success', 'Event created successfully.');  
        } else {  
            return redirect()->back()->withErrors(['error' => 'Failed to create event.']);  
        } 
    }

    public function updateEvent(Request $request, $event_name, $id)  
    {  
        $request->validate([  
            'name' => 'nullable|string|max:255',  
            'description' => 'nullable|string', 
            'category' => 'nullable|string|in:Education,Fashion & Beauty,Hobbies & Crafts,Music,Food & Drinks,Art & Culture,Tech & Start Up,Travel & Vacation', 
            'start_date' => 'nullable|date',  
            'end_date' => 'nullable|date|after:start_date',
            'location' => 'nullable|string|max:255',  
            'venue' => 'nullable|string|max:255',
            'banner_photo' => 'nullable|file|mimes:jpeg,jpg,png,gif|max:2048',
            'proposal_doc' => 'nullable|file|mimes:pdf,ppt,pptx,docx|max:5120'
        ]); 
        
        $event = Event::findOrFail($id); 

        $event->name = $request->input('name', $event->name);  
        $event->description = $request->input('description', $event->description);  
        $event->category = $request->input('category', $event->category);
        $event->start_date = $request->input('start_date', $event->start_date); 
        $event->end_date = $request->input('end_date', $event->end_date); 
        $event->location = $request->input('location', $event->location); 
        $event->venue = $request->input('venue', $event->venue);

        // Save banner as mediumblob
        if ($request->hasFile('banner_photo')) {  
            $file = $request->file('banner_photo')->getRealPath();  
            $event->banner_photo = file_get_contents($file);
        }

        // Save proposal as mediumblob
        if ($request->hasFile('proposal_doc')) {  
            $file = $request->file('proposal_doc')->getRealPath();  
            $event->proposal_doc = file_get_contents($file);
        } 
  
        $event->save();  

        return redirect()->route('myevent.detail', ['event_name' => $event_name])->with('success', 'Event updated successfully.');
    }

    public function deleteEvent($event_name, $id)  
    {  
        $event = Event::findOrFail($id);  

        $event->delete();  
 
        return redirect()->route('events')->with('success', 'Delete event success.');  
    }

    public function storeBoothCat(Request $request, $event_name)  
    {  
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
            'booth_price' => 'required|numeric|between:0,999999999999.99' 
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

    public function uploadLayout(Request $request, $event_name, $id)  
    {  
        $request->validate([
            'layout_photo' => 'nullable|file|mimes:jpeg,jpg,png|max:2048'
        ]); 
        
        $event = Event::findOrFail($id); 

        // Save layout as mediumblob
        if ($request->hasFile('layout_photo')) {  
            $file = $request->file('layout_photo')->getRealPath();  
            $event->layout_photo = file_get_contents($file);
        } 
  
        $event->save();  

        return redirect()->route('mybooth', ['event_name' => $event_name])->with('success', 'Booth layout uploaded successfully.');
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
            return redirect()->route('verif')->with('success', 'Profile verification added successfully.');  
        } else {  
            return redirect()->back()->withErrors(['error' => 'Failed to add verification.']);  
        }
    }

    public function updateVerifProfile(Request $request, $id)  
    {  
        $request->validate([  
            'id_num' => 'nullable|string|max:20',  
            'id_name' => 'nullable|string|max:255', 
            'id_address' => 'nullable|string|max:255',
            'id_photo' => 'nullable|file|mimes:jpeg,jpg,png|max:2048'
        ]); 
        
        $profile = Verification::findOrFail($id); 

        $profile->id_num = $request->input('id_num', $profile->id_num);  
        $profile->id_name = $request->input('id_name', $profile->id_name);  
        $profile->id_address = $request->input('id_address', $profile->id_address); 

        // Save file as mediumblob
        if ($request->hasFile('id_photo')) {  
            $file = $request->file('id_photo')->getRealPath();  
            $profile->id_photo = file_get_contents($file);
        }  
  
        $profile->save();  

        return redirect()->route('verif')->with('success', 'Profile verification updated successfully.');
    }

    public function storeBankAccount(Request $request)  
    {  
        $validatedData = $request->validate([  
            'account_num' => 'required|string|max:20',  
            'account_name' => 'required|string|max:255', 
            'bank_name' => 'required|string|max:255'
        ]);  

        $data = new BankAccount($validatedData);
        $data['user_id'] = Auth::id();

        if ($data->save()) {  
            return redirect()->route('account')->with('success', 'Bank account added successfully.');  
        } else {  
            return redirect()->back()->withErrors(['error' => 'Failed to add bank account.']);  
        }
    }

    public function updateBankAccount(Request $request, $id)  
    {  
        $request->validate([  
            'account_num' => 'nullable|string|max:20',  
            'account_name' => 'nullable|string|max:255', 
            'bank_name' => 'nullable|string|max:255'
        ]); 
        
        $bankAcc = BankAccount::findOrFail($id); 

        $bankAcc->account_num = $request->input('account_num', $bankAcc->account_num);  
        $bankAcc->account_name = $request->input('account_name', $bankAcc->account_name);  
        $bankAcc->bank_name = $request->input('bank_name', $bankAcc->bank_name); 

        $bankAcc->save();  

        return redirect()->route('account')->with('success', 'Bank account updated successfully.');
    }
}
