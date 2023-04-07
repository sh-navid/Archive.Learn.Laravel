<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class CookieController extends Controller
{
    function create(Request $request)
    {
        $response = new Response("Hello");
        $response->withCookie(cookie("MyCookieName", "MyCookieValue", 1000));
        return $response;
    }

    function read(Request $request)
    {
        $value = $request->cookie("MyCookieName");
        return $value;
    }

    function delete(Request $request)
    {
        Cookie::queue(Cookie::forget('MyCookieName'));
        return "Cookie Removed";
    }
}
