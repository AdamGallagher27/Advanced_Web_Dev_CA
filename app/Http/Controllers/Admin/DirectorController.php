<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Director;
use Illuminate\Support\Facades\Auth;


class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // auth user as the admin
        $user = Auth::user();
        $user->authorizeRoles("admin");

        // get all directors from datatabse
        $directors = Director::all();

        return view("admin.directors.index")->with("directors", $directors);
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

        return view("Admin.directors.create");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate request
        $request->validate([
            "name" => "required|max:100",
            "bio" => "required|max:120",
        ]);

        // create new director in db
        $director = Director::create([
            "name" => $request->name,
            "bio" => $request->bio,
        ]);


        return to_route("admin.directors.index")->with("success", "your director was updated successfully");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // authorize user as admin
        $user = Auth::user();
        $user->authorizeRoles("admin");

        // eager load director
        $director = Director::where("id", $id )->firstOrFail();

        // return form view with chosen director
        return view("Admin.directors.edit")->with("director", $director); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Director $director)
    {
        // validate request
        $request->validate([
            "name" => "required|max:100",
            "bio" => "required|max:120",
        ]);

        // update director in database
        $director->update([
            "name" => $request->name,
            "bio" => $request->bio,
        ]);

        return to_route("admin.directors.index")->with("success", "your director was updated successfully");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Director $director)
    {
        // authorize user as admin
        $user = Auth::user();
        $user->authorizeRoles("admin");

        // delete selected director
        $director->delete();

        // return to view all director route
        return to_route("admin.directors.index")->with('success', 'your director was deleted successfully');
    }
}
