<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'total_price'];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function cartProducts(){
        return $this->hasMany(CartProduct::class);
    }
}
