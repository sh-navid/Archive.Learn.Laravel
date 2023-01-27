<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function say(Request $request)
    {
        echo '<br/>URL: ' . $request->url();
        echo '<br/>URI: ' . $request->path();
        echo '<br/>Method: ' . $request->method();
    }
}
