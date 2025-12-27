<?php

namespace App\Notifications;

use App\Models\Bid;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BidAcceptedNotification extends Notification
{
    public $bid;

    public function __construct(Bid $bid)
    {
        $this->bid = $bid;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'bid_accepted',
            'product_id' => $this->bid->product_id,
            'amount' => $this->bid->amount,
            'message' => 'مبروك! تم قبول عرضك على: ' . $this->bid->product->title,
        ];
    }
}
