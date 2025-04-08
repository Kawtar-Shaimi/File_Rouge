<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'client_id'];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function wishlistBooks(){
        return $this->hasMany(WishlistBook::class);
    }
}
