<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['tenant_id', 'sender_id', 'receiver_id', 'product_id', 'message', 'is_read', 'deleted_for'];

    protected $casts = [
        'is_read' => 'boolean',
        'deleted_for' => 'array',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
