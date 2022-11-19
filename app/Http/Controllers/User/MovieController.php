<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;
use App\Models\User;




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

        // get movie from db with the id passed in
        $movie = Movie::where("id", $id)->firstOrFail();
        
        // get the user from database
        $user = User::where("id", $movie->user_id)->firstOrFail();

        // returns the show view with the movie variable
        return view("user/movies/show")->with("movie", $movie)->with("user", $user);
    }

    
}

