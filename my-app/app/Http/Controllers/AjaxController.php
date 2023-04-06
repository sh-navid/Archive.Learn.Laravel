<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function call(Request $request)
    {
        return "Hello from AJAX controller";
    }
}
