<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'nim',
        'name',
        'email',
        'phone',
        'choice_division',
        'motivation',
        'status',
    ];
}
