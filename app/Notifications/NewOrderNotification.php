<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;

    public function __construct(public Order $order)
    {
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'product_title' => $this->order->product->title,
            'buyer_name' => $this->order->buyer_name,
            'total_amount' => $this->order->total_amount,
            'message' => 'لديك طلب شراء جديد على منتج: ' . $this->order->product->title,
        ];
    }
}
