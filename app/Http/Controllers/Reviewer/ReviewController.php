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

    public function edit(Review $review)
    {

        return view('reviewer.reviews.edit')->with("review", $review);
    }

    public function update(Request $request,  Review $review)
    {

        // validating form input from edit()
        $request->validate( [
            "title" => "required|max:120",
            "description" => "required|max:200",
            "rating" => "required",
            "movie_id" => "required",
            "user_id" => "required",

        ]);


        // add new production company to databse
        $review->update([
            "title" => $request->title,
            "description" => $request->description,
            "rating" => $request->rating,
            "movie_id" => $request->movie_id,
            "user_id" => $request->user_id,
        ]);
    
        // return to movies show
        return redirect("reviewer/movies/" . $request->movie_id)->with('success', 'your review was updated successfully');
    }

    public function destroy(Review $review)
    {
        // authorize user as reviewer
        $user = Auth::user();
        $user->authorizeRoles("reviewer");

        // get the id for the movie before its deleted
        $movie_id = $review->movie_id;

        // delete selected director
        $review->delete();

        // return to movies show
        return redirect("reviewer/movies/" . $movie_id)->with('success', 'your review was deleted successfully');
    }

    
}

