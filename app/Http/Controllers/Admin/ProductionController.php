<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Director;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;
use App\Models\User;
use App\Models\Production;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // authorize user as admin
        $user = Auth::user();
        $user->authorizeRoles("admin");

        $productions = Production::all();

        return view("Admin.productions.index")->with("productions", $productions);
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
        return view("Admin.productions.create")->with('success', 'your production company was created successfully');

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
        ]);


        // add new production company to databse
        $production = Production::create([
            "title" => $request->title,
        ]);


        // return to productions / index
        return to_route("admin.productions.index")->with('success', 'your production company was created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Production $production)
    {
        // authorize user as admin
        $user = Auth::user();
        $user->authorizeRoles("admin");

        // returns view for create form
        // before its sent to the store function
        return view("Admin.productions.edit")->with("production", $production);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  Production $production)
    {

        // validating form input from edit()
        $request->validate( [
            "title" => "required|max:120",
        ]);


        // add new production company to databse
        $production->update([
            "title" => $request->title,
        ]);
    
        return to_route("admin.productions.index")->with('success', 'your production company was updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Production $production)
    {

        // authorize user as admin
        $user = Auth::user();
        $user->authorizeRoles("admin");

        // delete selected movie
        $production->delete();

        // return to view all movie route
        return to_route("admin.productions.index")->with('success', 'your movie was deleted successfully');;

    }
}
