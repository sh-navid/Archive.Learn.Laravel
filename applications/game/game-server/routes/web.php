<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::view("/register", "register");
Route::post("/register", function (Request $request) {
    $request["password"] = Hash::make($request['password']);

    $result = User::create($request);

    return $result;
    //return redirect("dashboard")->with('msg', 'You are registered');
});
