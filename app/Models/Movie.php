<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    // this is the relationship for user and movies (1:M)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // prevents mass assignment error
    protected $guarded = [];
}
