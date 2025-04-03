<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['client_id', 'total_price'];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function cartBooks(){
        return $this->hasMany(CartBook::class);
    }
}
