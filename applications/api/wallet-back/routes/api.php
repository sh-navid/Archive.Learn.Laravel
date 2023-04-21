<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::get("/record/list", function () {
    $data = json_encode([
        ["amount" => 12000, "type" => "IN"],
        ["amount" => 12000, "type" => "IN"],
        ["amount" => 12000, "type" => "IN"]
    ]);

    return response($data, 200)
        ->header('Content-Type', 'application/json');
});


// FIXME: fix this example for next class *****
// Route::middleware('auth:sanctum')->get("/record/list2", function () {
//     $data = json_encode([
//         ["amount" => 12000, "type" => "IN"],
//         ["amount" => 12000, "type" => "IN"],
//         ["amount" => 12000, "type" => "IN"]
//     ]);

//     return response($data, 200)
//         ->header('Content-Type', 'application/json');
// });


Route::get('fake', function () {
    User::create([
        "username" => "test",
        "password" => Hash::make("123"),
        "api_token" => null
    ]);
    return "User Created";
});


Route::post('register', function (Request $request) {
    $request["password"] = Hash::make($request->password);
    $user = User::create($request->only("username", "password"));
    return $user;
});


Route::post('login', function (Request $request) {
    if (Auth::attempt($request->only("username", "password"))) {
        $user = User::find(Auth::user()->id);
        $user->api_token = Str::random(60);
        $user->save();
        return Auth::user()->fresh();
    }
    return response()->json(['error' => 'Not authenticated', 'data' => $request->only("username")], 401);
});


Route::post('logout', function (Request $request) {
    $user = User::where("api_token", $request->api_token);
    $user->api_token = null;
    $user->save();
    return response()->json(['message' => 'You are logged out']);
});
