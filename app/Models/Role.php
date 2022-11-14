<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function users() {

        // lets us do $roles->users() to get all users
        return $this->belongsToMany("App/Models/User", "user_role");
    }

}
