<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\MyAuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UploadController;
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


Route::resource("/tasks", TaskController::class);
Route::resource("/comments", CommentController::class);


Route::get('/upload', function () {
    return view("upload");
});

Route::post('/upload', [UploadController::class, "uploadFile"]);



Route::view('login',     'login');
Route::view('register',  'register');

Route::get('dashboard',  [MyAuthController::class, 'dashboard']);
Route::get('logout',     [MyAuthController::class, 'logout']);

Route::post('login',     [MyAuthController::class, 'login']);
Route::post('register',  [MyAuthController::class, 'register']);
