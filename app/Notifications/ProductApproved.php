<?php

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductApproved extends Notification
{
    use Queueable;

    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function via($notifiable)
    {
        $channels = ['mail', 'database'];

        // Optional SMS channel (uses Vonage/Nexmo driver) if configured and user has phone
        if (env('SMS_NOTIFICATIONS') && ! empty($notifiable->phone)) {
            $channels[] = 'nexmo';
        }

        return $channels;
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('تم نشر إعلانك')
                    ->greeting('مرحبًا ' . $notifiable->name)
                    ->line('تمت الموافقة ونشر إعلانك: "' . $this->product->title . '"')
                    ->action('عرض الإعلان', url(route('products.show', $this->product)))
                    ->line('شكرًا لاستخدامك المنصة.');
    }

    public function toArray($notifiable)
    {
        return [
            'product_id' => $this->product->id,
            'title' => $this->product->title,
            'message' => 'تم نشر إعلانك: ' . $this->product->title,
        ];
    }
}
