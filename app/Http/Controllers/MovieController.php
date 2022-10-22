<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;



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
        $movies = Movie::where("user_id", Auth::id())->latest("updated_at")->paginate(5);

        // returning the view for index with the movies variable
        return view("movies/index")->with("movies", $movies);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // returns view for create form
        // before its sent to the store function
        return view("movies/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // validating form input from create()
        $request->validate( [
            "title" => "required|max:120",
            "director" => "required|max:120",
            "description" => "required",
            "image" => "required",
            "budget" => "required",
            "box_office" => "required"
        ]);

        // adding data to movie table
        Movie::create([
            "user_id" => Auth::id(),
            "title" => $request->title,
            "director" => $request->director,
            "description" => $request->description,
            "image" => $request->image,
            "budget" => $request->budget,
            "box_office" => $request->boxOffice,
        ]);


        // return to movies / index
        return to_route("movies.index");
        
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
        $movie = Movie::where("id", $id)->where("user_id", Auth::id())->firstOrFail();

        // returns the show view with the movie variable
        return view("movies/show")->with("movie", $movie);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
       

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

