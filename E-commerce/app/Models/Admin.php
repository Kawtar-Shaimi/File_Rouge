<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends User
{
    use Notifiable;

    protected $table = 'users';

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('admin', function ($builder) {
            $builder->where('role', 'admin');
        });
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
