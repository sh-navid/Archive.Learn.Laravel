<?php

use App\Http\Controllers\TaskController;
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


Route::resource("/tasks",TaskController::class);


Route::get('/test/{name}', function ($name) {
    return view("test");
});


Route::get('/csrf', function () {
    return view("csrf");
});


Route::post("/csrf-form", function () {
    // $data = file_get_contents('php://input');
    return "The value of input text is: " . $_POST["myText"];
});


use App\Http\Controllers\HelloController;
//Route::get("/say/hello", [HelloController::class, "say"]);
Route::get("/say/hello", [HelloController::class, "say"])->middleware("hello");


use App\Http\Controllers\BookController;
Route::resource("/book", BookController::class); // For default CRUD
// Route::controller("/book", BookController::class); // For Custom Controllers


Route::get('/show', function () {
    return view("book");
});


Route::get('/home', function () {
    return view('home', ['title' => 'My Page']);
});