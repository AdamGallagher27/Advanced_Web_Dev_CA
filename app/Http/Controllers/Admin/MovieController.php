<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Director;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;
use App\Models\User;
use App\Models\Production;
use App\Models\Review;



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

        $movies = Movie::where("user_id", Auth::id())->paginate(10);

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

        // get all the production companies and directors
        $productions = Production::all();
        $directors = Director::all();

        // returns view for create form
        // before its sent to the store function
        return view("Admin.movies.create")->with("productions", $productions)->with("directors", $directors);
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
            "directors" => ["required", "exists:directors,id"],
            "description" => "required",

            // image must be a file
            "image" => "file|image",
            "productions" => "required",
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
        $movie = Movie::create([
            "user_id" => Auth::id(),
            "title" => $request->title,
            // "director" => $request->director,
            "description" => $request->description,
            "image" => $fileName,
            "production_id" => $request->productions,
            "budget" => $request->budget,
            "box_office" => $request->box_office,
        ]);


        // add entry to pivot table
        $movie->directors()->attach($request->directors);


        // return to movies / index
        return to_route("admin.movies.index")->with('success', 'your movie was created successfully');;
        
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

        // get the selected production
        $production = Production::where("id", $movie->production_id)->first();

        // varaible for reviews
        $reviews = Review::where("movie_id", $movie->id)->get();

        // returns the show view with the movie / user variable
        return view("admin/movies/show")->with("movie", $movie)->with("user", $user)->with("production", $production)->with("reviews", $reviews);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {

        // get all the production companies
        $productions = Production::all();

        // get all the production companies
        $directors = Director::all();


        return view('admin.movies.edit')->with("movie", $movie)->with("productions", $productions)->with("directors", $directors);
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
            "directors" => ["required", "exists:directors,id"],
            "description" => "required",
            "image" => "required",
            "budget" => "required",
            "box_office" => "required",
            "productions" => "required"
        ]);


        // updating data in database
        $movie->update([
            "title" => $request->title,
            // "director" => $request->director,
            "description" => $request->description,
            "image" => $request->image,
            "budget" => $request->budget,
            "production_id" => $request->productions,
            "box_office" => $request->box_office
        ]);
        


        // update directors in pivot
        $chosenDirectors = $request->directors;
        $movie->directors()->detach();
        $movie->directors()->attach($chosenDirectors);


        return to_route("admin.movies.show", $movie)->with('success', 'your movie was updated successfully');
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

        // delete directors
        $movie->directors()->detach();

        // delete selected movie
        $movie->delete();

        // return to view all movie route
        return to_route("admin.movies.index")->with('success', 'your movie was deleted successfully');

    }
}

