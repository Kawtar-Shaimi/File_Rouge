<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishlistProduct extends Model
{
    protected $table = "wishlists_products";

    protected $fillable = ['wishlist_id', 'product_id'];

    public function wishlist(){
        return $this->belongsTo(Wishlist::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
