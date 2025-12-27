<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $conversations = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['sender', 'receiver', 'product'])
            ->latest()
            ->get()
            ->groupBy(function ($message) use ($userId) {
                return $message->sender_id == $userId ? $message->receiver_id : $message->sender_id;
            })
            ->map(function ($messages) {
                return $messages->first();
            });

        return view('chat.index', compact('conversations'));
    }

    public function show($id)
    {
        try {
            $userId = decrypt($id);
        } catch (\Exception $e) {
            $userId = $id;
        }
        $user = User::findOrFail($userId);

        $messages = Message::where(function ($q) use ($user) {
            $q->where('sender_id', auth()->id())->where('receiver_id', $user->id);
        })
            ->orWhere(function ($q) use ($user) {
                $q->where('sender_id', $user->id)->where('receiver_id', auth()->id());
            })
            ->with(['sender', 'receiver', 'product'])
            ->orderBy('created_at', 'asc')
            ->get();

        Message::where('sender_id', $user->id)
            ->where('receiver_id', auth()->id())
            ->update(['is_read' => true]);

        return view('chat.show', compact('user', 'messages'));
    }

    public function store(Request $request, $id)
    {
        $request->validate(['message' => 'required|string']);

        try {
            $userId = decrypt($id);
        } catch (\Exception $e) {
            $userId = $id;
        }
        $user = User::findOrFail($userId);

        Message::create([
            'tenant_id' => auth()->user()->tenant_id ?? 1,
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'product_id' => $request->product_id,
            'message' => $request->message,
        ]);

        return redirect()->route('chat.show', encrypt($userId));
    }
}
