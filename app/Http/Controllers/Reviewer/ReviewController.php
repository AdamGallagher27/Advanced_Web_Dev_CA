<?php

namespace App\Http\Controllers\Reviewer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;
use App\Models\User;
use App\Models\Production;
use App\Models\Review;







class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create( $movie_id)
    {

        // authorize user as admin
        $user = Auth::user();
        $user->authorizeRoles("reviewer");



        // returns view for create form
        // before its sent to the store function
        return redirect("Reviewer.reviews.create")->with("movie_id", $movie_id);
    }



    

    
}

