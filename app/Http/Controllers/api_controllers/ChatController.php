<?php

namespace App\Http\Controllers\api_controllers;

use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    // Send a message
    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);
        event(new MessageSent($message));

        return response()->json($message, 200);
    }

    // Get messages between two users
    public function getMessages(Request $request)
    {
        $messages = Message::where(function ($query) use ($request) {
            $query->where('sender_id', $request->sender_id)
                  ->where('receiver_id', $request->receiver_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('sender_id', $request->receiver_id)
                  ->where('receiver_id', $request->sender_id);
        })->get();

        return response()->json($messages, 200);
    }
}
