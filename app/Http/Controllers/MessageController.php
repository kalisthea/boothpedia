<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Event;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\Eventorganizer;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{


    public function searchEO(Request $request)
    {

        $checkUser = Auth::user();
        $checkEO = Auth::guard('eventorganizers')->user();
        $query = $request->input('finduser');

     
        if ($checkUser instanceof User ) {
            $users = Eventorganizer::where('name', $query)->get();

            if ($users->isEmpty()) {
                return back()->with('error', 'User not found.');
            }

            foreach ($users as $user) {
                $chat = Chat::where(function ($query) use ($user) {
                    $query->where('tenant_id', Auth::user()->id)
                          ->where('eo_id', $user->id);
                })->first();
        
                if (!$chat) {
                    $chat = Chat::create([
                        'tenant_id' => Auth::user()->id,
                        'eo_id' => $user->id
                    ]);
                    
                }
            }

            $chats = Chat::where('tenant_id', $checkUser)->pluck('eo_id');
            return view('cmtenant', compact('chats'));

        } elseif ($checkEO instanceof Eventorganizer) {
            $users = User::where('name', 'LIKE', '%' . $query . '%')->get();

            if ($users->isEmpty()) {
                return back()->with('error', 'User not found.');
            }

            foreach ($users as $user) {
                $chat = Chat::where(function ($query) use ($user) {
                    $query->where('eo_id', Auth::guard('eventorganizers')->user()->id)
                          ->where('tenant_id', $user->id);
                })->first();
        
                if (!$chat) {
                    $chat = Chat::create([
                        'eo_id' => Auth::guard('eventorganizers')->user()->id,
                        'tenant_id' => $user->id
                    ]);
                    
                }
            }

            $chats = Chat::all();
            return view('cmtenant', compact('chats'));
        }
    }



    public function showChatBox($eo_id){
        if(Chat::where('receiver_id', $eo_id)->exists()){
            $chats = Chat::where('receiver_id', $eo_id)->first();
            return view('cmtenantactive', compact('chats'));
        }
        else{
            return redirect('/chatmessage-tenant')->with('status',"Event does not exists");
        }
   }


    public function sendMessage(Request $request)
    {
        $message = new Message;
        $message->sender_id = Auth::user(); 
        $message->receiver_id = $request->receiver_id;
        $message->message = $request->message;
        $message->save();

        return redirect(route("chatmessage-tenant"));
    }

    public function getMessages($userId)
    {
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_name', Auth::user())
                ->where('receiver_name', $userId)
                ->orWhere('sender_name', $userId)
                ->where('receiver_name', Auth::user());
        })->orderBy('created_name')->get();

        return view('messages.chat', compact('messages', 'userId'));
    }
}
