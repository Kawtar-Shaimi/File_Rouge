<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends User
{
    protected $table = 'users';

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('publisher', function ($builder) {
            $builder->where('role', 'publisher');
        });
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}