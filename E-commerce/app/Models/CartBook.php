<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartBook extends Model
{
    protected $table = "carts_books";

    protected $fillable = ['cart_id', 'book_id', 'quantity'];

    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    public function book(){
        return $this->belongsTo(Book::class);
    }

}
