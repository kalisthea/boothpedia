<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = new Message;
        $message->sender_id = Auth::user(); // Assuming authenticated user
        $message->receiver_id = $request->receiver_id;
        $message->message = $request->message;
        $message->save();

        return redirect()->back()->with('success', 'Message sent successfully.');
    }

    public function getMessages($userId)
    {
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', Auth::user();)
                ->where('receiver_id', $userId)
                ->orWhere('sender_id', $userId)
                ->where('receiver_id', auth()->id());
        })->orderBy('created_at')->get();

        return view('messages.chat', compact('messages', 'userId'));
    }
}
