<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get("/record/list", function () {
    $data = json_encode([
        ["amount" => 12000, "type" => "IN"],
        ["amount" => 12000, "type" => "IN"],
        ["amount" => 12000, "type" => "IN"]
    ]);

    return response($data, 200)
        ->header('Content-Type', 'application/json');
});
