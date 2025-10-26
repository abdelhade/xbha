<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class NotificationsList extends Component
{
    use WithPagination;

    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();
        
        if (isset($notification->data['order_id'])) {
            return redirect()->route('orders.show', $notification->data['order_id']);
        }
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        session()->flash('message', 'تم تحديد جميع الإشعارات كمقروءة');
    }

    public function render()
    {
        $notifications = auth()->user()->notifications()->paginate(20);
        
        return view('livewire.notifications-list', compact('notifications'));
    }
}
