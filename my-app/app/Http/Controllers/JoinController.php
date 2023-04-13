<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class JoinController extends Controller
{
    function join()
    {
        return User::join("posts", "users.id", "=", "posts.user_id")->get(["users.name", "posts.title"]);
    }

    function where()
    {
        return User::join("posts", "users.id", "=", "posts.user_id")->where("users.id", 1)->get(["users.name", "posts.title"]);
    }
}
