<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function uploadFile(Request $request)
    {
        $file = $request->file('myFile');

        echo 'Name: ' . $file->getClientOriginalName();
        echo ' - Extension: ' . $file->getClientOriginalExtension();
        echo ' - Size: ' . $file->getSize();
        echo ' - Type: ' . $file->getMimeType();

        $file->move('uploads', $file->getClientOriginalName());
    }
}
