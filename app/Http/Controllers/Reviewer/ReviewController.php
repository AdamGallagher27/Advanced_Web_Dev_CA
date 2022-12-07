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


    public function create()
    {


        // get the movie id from the get array
        $movie_id = $_GET["movie_id"];


        // authorize user as admin
        $user = Auth::user();
        $user->authorizeRoles("reviewer");

        // returns view for create form
        // before its sent to the store function
        return view("Reviewer.reviews.create")->with("movie_id", $movie_id);
    }

    public function store(Request $request)
    {


        // validating form input from create()
        $request->validate( [
            "title" => "required|max:120",
            "description" => "required|max:200",
            "rating" => "required",
            "movie_id" => "required|numeric",
        ]);



        // // adding data to review table
        $review = Review::create([
            "movie_id" => $request->movie_id,
            "user_id" => Auth::id(),
            "title" => $request->title,
            "description" => $request->description,
            "rating" => $request->rating,
        ]);


        // return to movies show
        return redirect("reviewer/movies/" . $request->movie_id)->with('success', 'your review was created successfully');
        
    }

    

    
}

