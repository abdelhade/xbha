<?php

namespace App\Http\Controllers;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notifications.index');
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        if (isset($notification->data['order_id'])) {
            return redirect()->route('orders.show', $notification->data['order_id']);
        }

        return back();
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return back()->with('success', 'تم تحديد جميع الإشعارات كمقروءة');
    }
}
