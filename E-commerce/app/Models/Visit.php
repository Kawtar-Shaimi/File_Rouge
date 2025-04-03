<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $table = 'visits';

    public $timestamps = false;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'last_visited_url',
        'last_visit',
    ];

}
