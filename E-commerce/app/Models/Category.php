<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=[
        'name',
        'description',
        'admin_id'
    ];

    public function book (){
        return $this->hasMany(Book::class);
    }

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
