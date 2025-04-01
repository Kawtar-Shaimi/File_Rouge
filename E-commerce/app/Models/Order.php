<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'shipping_address',
        'shipping_city',
        'shipping_postal_code',
        'shipping_country',
        'shipping_phone',
        'shipping_email',
        'shipping_name',
        'payment_method',
        'total_amount',
        'status',
        'client_id'
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function orderProducts(){
        return $this->hasMany(OrderProduct::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
