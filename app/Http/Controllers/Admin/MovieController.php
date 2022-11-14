<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        // authorize user as admin
        $user = Auth::user();
        $user->authorizeRoles("admin");

        $movies = Movie::paginate(10);

        return view("Admin.movies.index")->with("movies", $movies);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // authorize user as admin
        $user = Auth::user();
        $user->authorizeRoles("admin");

        // returns view for create form
        // before its sent to the store function
        return view("Admin.movies.create");
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

            // image must be a file
            "image" => "file|image",
            "budget" => "required",
            "box_office" => "required"
        ]);

        $image = $request->file("image");
        // gets the correct file extension (jpeg, png) 
        $extension = $image->getClientOriginalExtension();

        // creates unique filename for image 
        $fileName = date("Y-m-d-His") . "_" . $request->input("title") . "." . $extension;

        // stores image in public / images folder
        $path = $image->storeAs("public/images", $fileName);


        // adding data to movie table
        Movie::create([
            "user_id" => Auth::id(),
            "title" => $request->title,
            "director" => $request->director,
            "description" => $request->description,
            "image" => $fileName,
            "budget" => $request->budget,
            "box_office" => $request->box_office,
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
    public function edit(Movie $movie)
    {
        return view('movies.edit')->with("movie", $movie);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        // validating form input from edit()
        $request->validate( [
            "title" => "required|max:120",
            "director" => "required|max:120",
            "description" => "required",
            "image" => "required",
            "budget" => "required",
            "box_office" => "required"
        ]);


        // updating data in database
        $movie->update([
            "title" => $request->title,
            "director" => $request->director,
            "description" => $request->description,
            "image" => $request->image,
            "budget" => $request->budget,
            "box_office" => $request->box_office
        ]);
        

        return to_route("movies.show", $movie);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {

        // user validation
        // if user isnt authenticated throw 403 error
        if($movie->user_id != Auth::id()) {
            return abort(403);
        }


        // delete selected movie
        $movie->delete();

        // return to view all movie route
        return to_route("movies.index");

    }
}

