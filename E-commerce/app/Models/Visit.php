<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $table = 'visits';

    public $timestamps = false;

    protected $fillable = [
        'uuid',
        'ip_address',
        'user_agent',
        'last_visited_url',
        'last_visit',
    ];

}
