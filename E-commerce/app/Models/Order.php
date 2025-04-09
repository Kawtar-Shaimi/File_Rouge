<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
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
        'cancellation_reason',
        'client_id'
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function orderBooks(){
        return $this->hasMany(OrderBook::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
