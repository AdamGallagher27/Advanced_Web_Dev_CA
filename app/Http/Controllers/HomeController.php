<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
        return redirect()->route($home);
    }
    
}
