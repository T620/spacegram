<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ChatRoom;
use App\Models\ChatMessages;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use App\Providers\App\Events\NewChatMessage;

class ChatController extends Controller
{
    public function rooms(Request $request)
    {
        return ChatRoom::all();
    }

    public function messages(Request $request, $roomId)
    {        
        $messages = ChatMessages::where('chat_room_id', $roomId)
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->get();
        
        return $messages;
    }

    public function new_message(Request $request, $roomId)
    {
        $newMessage = ChatMessages::create([
            'user_id' => Auth::id(),
            'chat_room_id' => $roomId,
            'message' => $request->message
        ])->refresh();

        broadcast(new NewChatMessage($newMessage))->toOthers();

        return $newMessage;
    }
}
