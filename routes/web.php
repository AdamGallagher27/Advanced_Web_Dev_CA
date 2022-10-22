<?php

use Illuminate\Support\Facades\Route;

// have to get movie controller
use App\Http\Controllers\MovieController;


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
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



// route for the index function
Route::get('/index', [MovieController::class, "index"])->middleware(["auth"]);

// route for the create function
Route::get('/create', [MovieController::class, "create"])->middleware(["auth"]);

// route for the show function
Route::get('/show', [MovieController::class, "show"])->middleware(["auth"]);



Route::resource("/movies", MovieController::class)->middleware(["auth"]);

require __DIR__.'/auth.php';
