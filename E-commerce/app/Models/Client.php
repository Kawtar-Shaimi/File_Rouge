<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Client extends User
{
    use Notifiable;

    protected $table = 'users';

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('client', function ($builder) {
            $builder->where('role', 'client');
        });
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function wishlist(){
        return $this->hasOne(Wishlist::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}