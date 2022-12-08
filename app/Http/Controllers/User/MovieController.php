<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;
use App\Models\User;
use App\Models\Production;
use App\Models\Review;
use App\Models\Like;






class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    //  index function gets all movies from the database
    public function index()
    {

        // authorize user as ordinary user
        $user = Auth::user();
        $user->authorizeRoles("user");

        // variable to hold the movies from DB
        $movies = Movie::latest("updated_at")->paginate(5);

        // returning the view for index with the movies variable
        return view("user/movies/index")->with("movies", $movies);
       
    }

    


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // authorize user as ordinary user
        $currentUser = Auth::user();
        $currentUser->authorizeRoles("user");

        // get movie from db with the id passed in
        $movie = Movie::where("id", $id)->firstOrFail();
        
        // get the user from database
        $user = User::where("id", $movie->user_id)->firstOrFail();

        // varaible for production company
        $production = Production::where("id", $movie->production_id)->firstOrFail();

        // varaible for reviews
        $reviews = Review::where("movie_id", $movie->id)->get();

        // get all the users who have the reviewer role
        $reviewers = User::whereHas(
            'roles', function($q){
                $q->where('name', 'reviewer');
            }
        )->get();


        // returns the show view with the movie variable
        return view("user/movies/show")->with("movie", $movie)
        ->with("user", $user)->with("production", $production)
        ->with("reviews", $reviews)->with("reviewers", $reviewers)
        ->with("currentUser", $currentUser);
    }

    
    public function likedMovies()
    {

        // authorize user as ordinary user
        $user = Auth::user();
        $user->authorizeRoles("user");

        // get all the movies that the user liked
        $movies = Movie::whereHas(
            'likes', function($q)  use ($user){
                $q->where('user_id', $user->id);
            }
        )->get();

        // returning the view for index with the movies variable
        return view("user/movies/likedMovies")->with("movies", $movies);
       
    }
    
}

