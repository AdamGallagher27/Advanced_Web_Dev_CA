<?php

use Illuminate\Support\Facades\Route;

// have to get movie controller
use App\Http\Controllers\Admin\MovieController as AdminMovieController;
use App\Http\Controllers\User\MovieController as UserMovieController;
use App\Http\Controllers\Reviewer\MovieController as ReviewerMovieController;


// use production controller
use App\Http\Controllers\Admin\ProductionController as AdminProductionController;

// use director controller
use App\Http\Controllers\Admin\DirectorController as AdminDirectorController;

// use review controller
use App\Http\Controllers\Reviewer\ReviewController;


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


// dashboard redirects to home route
Route::get('/dashboard', function () {
    return redirect('/../home');
})->middleware(['auth', 'verified'])->name("dashboard");


require __DIR__.'/auth.php';




// home route
Route::get("/home", [App\Http\Controllers\HomeController::class, "index"])->name("home.index");

// creates all routes for the reviewer user
Route::resource("/reviewer/reviews", ReviewController::class)->middleware(["auth"])->names("reviewer.reviews");


// creates all routes for the admin users movies
Route::resource("/admin/movies", AdminMovieController::class)->middleware(["auth"])->names("admin.movies");

// // creates all routes for the admin users productions
Route::resource("/admin/productions", AdminProductionController::class)->middleware(["auth"])->names("admin.productions");

// creates all routes for the admin users directors
Route::resource("/admin/directors", AdminDirectorController::class)->middleware(["auth"])->names("admin.directors");

// resource for extra method in ordinary user controller
Route::get('/user/movies/likedMovies', 'App\Http\Controllers\User\MovieController@likedMovies')->name('user.likedMovies');

// creates all routes for the ordinary user
Route::resource("/user/movies", UserMovieController::class)->middleware(["auth"])->names("user.movies");

// creates all routes for the reviewer user
Route::resource("/reviewer/movies", ReviewerMovieController::class)->middleware(["auth"])->names("reviewer.movies");

