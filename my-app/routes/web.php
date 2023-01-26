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

Route::get('/about', function () {
    return view("about");
});

Route::get('/test/{name}', function ($name) {
    return view("test");
});

Route::match(['get', 'post'], '/match', function () {
    return "Route Match";
});

Route::any('/any', function () {
    return "Route Any";
});

Route::redirect('/root', '/home', 301);

Route::get('/csrf', function () {
    return view("csrf");
});