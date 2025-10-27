<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Component;

class ChatList extends Component
{
    public function render()
    {
        
        $userId = auth()->id();
        
        $conversations = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['sender', 'receiver'])
            ->latest()
            ->get()
            ->groupBy(function($message) use ($userId) {
                return $message->sender_id == $userId ? $message->receiver_id : $message->sender_id;
            })
            ->map(function($messages) {
                return $messages->first();
            });

        return view('livewire.chat-list', compact('conversations'));
    }
}
