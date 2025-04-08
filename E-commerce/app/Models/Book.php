<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'description',
        'price',
        'stock',
        'image',
        'category_id',
        'publisher_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function cartBooks(){
        return $this->hasMany(CartBook::class);
    }

    public function orderBooks(){
        return $this->hasMany(OrderBook::class);
    }

    public function publisher(){
        return $this->belongsTo(Publisher::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
