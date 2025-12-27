<?php

namespace App\Notifications;

use App\Models\Bid;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductBidNotification extends Notification
{

    public $bid;

    public function __construct(Bid $bid)
    {
        $this->bid = $bid;
    }

    public function via($notifiable)
    {
        return ['database']; // You can add 'mail' if needed
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'new_bid',
            'product_id' => $this->bid->product_id,
            'amount' => $this->bid->amount,
            'bidder_name' => $this->bid->user->name,
            'message' => 'قام ' . $this->bid->user->name . ' بالمزايدة على إعلانك: ' . $this->bid->product->title,
        ];
    }
}
