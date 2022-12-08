<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserRole;


// checks what role the user has and sends them to the right index
class HomeController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }

    public function index(Request $request) {
        $user = Auth::user();
        $home = "home";

        if($user->hasRole("admin")) {
            $home = "admin.movies.index";
        }
        else if($user->hasRole("user")) {
            $home = "user.movies.index";
        }
        else if($user->hasRole("reviewer")) {
            $home = "reviewer.movies.index";
        }
        // else the user is new and does not have a role
        else {
            $userRole = new UserRole;
            $userRole->user_id = $user->id;
            $userRole->role_id = 2;
            $userRole->save();

            $home = "user.movies.index";
        }
        return redirect()->route($home);
    }
    
}
