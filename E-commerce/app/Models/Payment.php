<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'method',
        'status',
        'amount',
        'order_id',
        'order_number'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
