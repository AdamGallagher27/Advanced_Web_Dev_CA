<?php

use Illuminate\Support\Facades\Route;

// have to get movie controller
use App\Http\Controllers\Admin\MovieController as AdminMovieController;
use App\Http\Controllers\User\MovieController as UserMovieController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';


// home route
Route::get("/home", [App\Http\Controllers\HomeController::class, "index"])->name("home.index");

// creates all routes for the admin user
Route::resource("/admin/movies", AdminMovieController::class)->middleware(["auth"])->names("admin.movies");

// creates all routes for the ordinary user
Route::resource("/user/movies", UserMovieController::class)->middleware(["auth"])->names("user.movies");