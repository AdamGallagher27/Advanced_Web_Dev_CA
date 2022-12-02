<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    // this is the relationship for review and movies (1:M)
    public function movies()
    {
        return $this->hasMany(Movie::class);
    }

    protected $guarded = [];

}
