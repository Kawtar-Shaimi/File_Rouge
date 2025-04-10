<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistBook extends Model
{
    protected $table = "wishlists_books";

    protected $fillable = ['wishlist_id', 'book_id'];

    public function wishlist(){
        return $this->belongsTo(Wishlist::class);
    }

    public function book(){
        return $this->belongsTo(Book::class);
    }
}
