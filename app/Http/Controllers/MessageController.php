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

        $checkUser = Auth::user()->role;
        $query = $request->input('finduser');

     
        if ($checkUser == "tenant" ) {
            $users = User::where('name', $query)->where('role', 'eventorganizer')->get();

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

        } elseif ($checkUser == "eventorganizer") {
            $users = User::where('name', $query)->where('role', 'tenant')->get();

            if ($users->isEmpty()) {
                return back()->with('error', 'User not found.');
            }

            foreach ($users as $user) {
                $chat = Chat::where(function ($query) use ($user) {
                    $query->where('eo_id', Auth::user()->id)
                          ->where('tenant_id', $user->id);
                })->first();
        
                if (!$chat) {
                    $chat = Chat::create([
                        'eo_id' => Auth::user()->id,
                        'tenant_id' => $user->id
                    ]);
                    
                }
            }
        }

        return redirect()->back();
    }

    public function showStartedChats(){
        $checkUser = Auth::user()->role;

        if ($checkUser == "tenant") {
            $chats = Chat::where('tenant_id', Auth::user()->id)->get(); 
        } elseif ($checkUser == "eventorganizer") {
            $chats = Chat::where('eo_id', Auth::user()->id)->get();
        }

        return view('cmtenant', compact('chats'));
    }



//     public function showChatBox($chat_id){

     
//         if(Chat::where('id', $chat_id)->exists()){
//             $chats = Chat::where('id', $chat_id)->first();
//             return view('cmtenantactive', compact('chats'));
//         }
//         else{
//             return redirect('/chatmessage')->with('status',"Event does not exists");
//         }
        
        
//    }


    public function sendMessage(Request $request, $chat_id)
    {   
        if ($request->isMethod('get')) {
            if(Chat::where('id', $chat_id)->exists()){
                $chats = Chat::where('id', $chat_id)->first();
                $messages = Message::where('chat_id', $chat_id)->orderBy('created_at')->get();
                return view('cmtenantactive', compact('chats', 'messages'));
            }
            else{
                return redirect('/chatmessage')->with('status',"Event does not exists");
            }

            
        }
        else{
            $checkUser = Auth::user()->role;

            if ($checkUser == "tenant") {
                $message = new Message;
                $message->chat_id = $chat_id; 
                $message->message = $request->sendtext;
                $message->sender = "tenant";
                $message->save();
    
            } elseif ($checkUser == "eventorganizer") {
                $message = new Message;
                $message->chat_id = $chat_id; 
                $message->message = $request->sendtext;
                $message->sender = "eventorganizer";
                $message->save();
            }
           
            return redirect()->back();
            // return redirect(route("message.post"));
        }
        

       
    }

    public function getMessages($chat_id)
    {
        $messages = Message::where('chat_id', $chat_id)->orderBy('created_at')->get();
        $userRole = Auth::user()->role;

        return view('cmtenantactive', compact('messages', 'userRole'));
    }
}
