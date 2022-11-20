<?php

use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\Admin\PublisherController as AdminPublisherController;
use App\Http\Controllers\User\PublisherController as UserPublisherController;

use Database\Seeders\BookSeeder;
use Illuminate\Support\Facades\Route;

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
// I think we can get rid of this...test later
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::get('/home/publishers', [App\Http\Controllers\HomeController::class, 'publisherIndex'])->name('home.publisher.index');


// This will create all the routes for Book
// and the routes will only be available when a user is logged in
Route::resource('/admin/books', AdminBookController::class)->middleware(['auth'])->names('admin.books');
Route::resource('/user/books', UserBookController::class)->middleware(['auth'])->names('user.books')->only(['index', 'show']);


// This will create all the routes for Publisher functionality.
// and the routes will only be available when a user is logged in
Route::resource('/admin/publishers', AdminPublisherController::class)->middleware(['auth'])->names('admin.publishers');

// the ->only at the end of this statement says only create the index and show routes.
Route::resource('/user/publishers',UserPublisherController::class)->middleware(['auth'])->names('user.publishers')->only(['index', 'show']);

