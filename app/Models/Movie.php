<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public function directors(){
        return $this->belongsToMany(Director::class)->withTimestamps();
    }


    // this is the relationship for user and movies (1:M)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // this is the relationship for production and movies (1:M)
    public function production()
    {
        return $this->belongsTo(Production::class);
    }

    // prevents mass assignment error
    protected $guarded = [];
}
