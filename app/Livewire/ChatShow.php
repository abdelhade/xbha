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
    public $editingMessageId = null;
    public $editingMessageText = '';
    public $deletingMessageId = null;

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

    public function showDeleteOptions($messageId)
    {
        $this->deletingMessageId = $messageId;
    }

    public function cancelDelete()
    {
        $this->deletingMessageId = null;
    }

    public function deleteForMe($messageId)
    {
        $message = Message::where('id', $messageId)
            ->where('sender_id', auth()->id())
            ->first();
        
        if ($message) {
            $deletedFor = $message->deleted_for ?? [];
            $deletedFor[] = auth()->id();
            $message->update(['deleted_for' => $deletedFor]);
        }
        $this->deletingMessageId = null;
    }

    public function deleteForEveryone($messageId)
    {
        $message = Message::where('id', $messageId)
            ->where('sender_id', auth()->id())
            ->first();
        
        if ($message) {
            $message->update(['message' => 'تم حذف هذه الرسالة']);
        }
        $this->deletingMessageId = null;
    }

    public function startEdit($messageId, $messageText)
    {
        $this->editingMessageId = $messageId;
        $this->editingMessageText = $messageText;
    }

    public function cancelEdit()
    {
        $this->editingMessageId = null;
        $this->editingMessageText = '';
    }

    public function saveEdit()
    {
        $message = Message::where('id', $this->editingMessageId)
            ->where('sender_id', auth()->id())
            ->first();
        
        if ($message && $this->editingMessageText) {
            $message->update(['message' => $this->editingMessageText]);
            $this->cancelEdit();
        }
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
            ->get()
            ->filter(function($message) {
                $deletedFor = $message->deleted_for ?? [];
                return !in_array(auth()->id(), $deletedFor);
            });

        Message::where('sender_id', $this->userId)
            ->where('receiver_id', auth()->id())
            ->update(['is_read' => true]);

        return view('livewire.chat-show', compact('messages'));
    }
}
