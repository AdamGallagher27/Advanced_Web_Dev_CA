<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    // this is the relationship for movies / production
    public function movies() {
        return $this->hasMany(Movie::class);
    }

}
