<?php

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

Route::get('/home', function () {
    return "<h1>Home Page</h1>";
});

Route::post('/post', function () {
    return "<h1>Post Request</h1>";
});

Route::put('/Put', function () {
    return "<h1>put Request</h1>";
});

Route::delete('/Delete', function () {
    return "<h1>Post Request</h1>";
});

Route::patch('/Patch', function () {
    return "<h1>Patch Request</h1>";
});

Route::get('/about', function () {
    return view("about");
});
