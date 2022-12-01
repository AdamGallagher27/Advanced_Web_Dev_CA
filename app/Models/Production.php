<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Production extends Model
{
    use HasFactory;
    use SoftDeletes;

    // this is the relationship for movies / production
    public function movies() {
        return $this->hasMany(Movie::class);
    }

    // prevents mass assignment error
    protected $guarded = [];

}
