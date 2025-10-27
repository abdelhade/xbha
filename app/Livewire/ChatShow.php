<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class ChatShow extends Component
{
    public $userId;
    public $user;
    public $message = '';

    public function mount($id)
    {
        try {
            $this->userId = decrypt($id);
        } catch (\Exception $e) {
            $this->userId = $id;
        }
        $this->user = User::findOrFail($this->userId);
    }

    public function sendMessage()
    {
        $this->validate(['message' => 'required|string']);

        Message::create([
            'tenant_id' => auth()->user()->tenant_id ?? 1,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->userId,
            'message' => $this->message,
        ]);

        $this->message = '';
        $this->dispatch('messageSent');
    }

    public function render()
    {
        $messages = Message::where(function($q) {
                $q->where('sender_id', auth()->id())->where('receiver_id', $this->userId);
            })
            ->orWhere(function($q) {
                $q->where('sender_id', $this->userId)->where('receiver_id', auth()->id());
            })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();

        Message::where('sender_id', $this->userId)
            ->where('receiver_id', auth()->id())
            ->update(['is_read' => true]);

        return view('livewire.chat-show', compact('messages'));
    }
}
