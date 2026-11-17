<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assignment extends Model
{
    protected $fillable = [
        'title',
        'description',
        'course_name',
        'class_name',
        'allowed_extensions',
        'deadline',
    ];

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }
}
