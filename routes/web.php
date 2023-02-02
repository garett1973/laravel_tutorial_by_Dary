<?php

use App\Http\Controllers\FallbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
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

/*
    Six options to use:
    GET - Request a resource
    POST - Create a new resource
    PUT - Update a resource - modifies the entire resource
    DELETE - Delete a resource
    PATCH - Modify a resource - modifies a part of the resource
    OPTIONS - Get the options for a resource. Ask the server which verbs are supported by a resource
 */

Route::get('/', function () {
    return view('welcome');
});

// Route for the invoke method
Route::get('/home', HomeController::class);

//Route::resource('blog', PostsController::class);

// GET all blog posts
Route::get('/blog', [PostsController::class, 'index'])->name('blog.index');

// GET a single blog post
//Route::get('/blog/{id?}', [PostsController::class, 'show']); // ? makes the parameter optional
//Route::get('/blog/{id}', [PostsController::class, 'show'])
//    ->where('id', '[0-9]+'); // Accepts only numbers

// The same way as above, but with a different parameter name
// Named routes
Route::get('/blog/{id}', [PostsController::class, 'show'])
    ->whereNumber('id')->name('blog.show'); // Accepts only numbers}')

//
//Route::get('/blog/{name}', [PostsController::class, 'show'])
//    ->where('name', '[A-Za-z-]+'); // Accepts only letters and dashes

// The same way as above, but with a different parameter name

//Route::get('/blog/{name}', [PostsController::class, 'show'])
//    ->whereAlpha('name')->name('blog.show'); // Accepts only letters and dashes

//Route::get('/blog/{id}/{name}', [PostsController::class, 'show'])
//    ->where(
//        [
//            'id' => '[0-9]+',
//            'slug' => '[A-Za-z-]+'
//        ]); // Accepts only numbers, letters and dashes

// The same way as above, but with a different parameter name

Route::get('blog/{id}/{name}', [PostsController::class, 'show'])
    ->whereNumber('id')
    ->whereAlpha('name'); // Accepts only numbers, letters and dashes

//----------------------------------------------------------------------
// GET a form to create a new blog post
Route::get('/blog/create', [PostsController::class, 'create'])->name('blog.create');

// POST a new blog post
Route::post('/blog', [PostsController::class, 'store'])->name('blog.store');
//----------------------------------------------------------------------
// GET a form to edit a blog post
Route::get('/blog/{id}/edit', [PostsController::class, 'edit'])->name('blog.edit');

// PUT/PATCH a blog post
Route::put('/blog/{id}', [PostsController::class, 'update'])->name('blog.update');
//----------------------------------------------------------------------
// DELETE a blog post
Route::delete('/blog/{id}', [PostsController::class, 'destroy'])->name('blog.destroy');

// Multiple routes for the same controller. Multiple HTTP verbs
//Route::match(['GET', 'POST'], '/blog', [PostsController::class, 'index']);

// Any HTTP verb
//Route::any('/blog', [PostsController::class, 'index']);

// Return a view
//Route::view('/view', 'blog.index', ['name' => 'Virgis the Destroyer']);

Route::prefix('/blog')->group(function () {
    Route::get('/', [PostsController::class, 'index'])->name('blog.index');
    Route::get('/{id}', [PostsController::class, 'show'])->name('blog.show');
    Route::get('/create', [PostsController::class, 'create'])->name('blog.create');
    Route::post('/', [PostsController::class, 'store'])->name('blog.store');
    Route::get('/{id}/edit', [PostsController::class, 'edit'])->name('blog.edit');
    Route::put('/{id}', [PostsController::class, 'update'])->name('blog.update');
    Route::delete('/{id}', [PostsController::class, 'destroy'])->name('blog.destroy');
});

// Fallback route
Route::fallback(FallbackController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
