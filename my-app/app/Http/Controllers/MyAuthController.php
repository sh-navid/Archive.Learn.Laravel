<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MyAuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails())
            return redirect("login")->with('msg', 'Validation Error');

        if (Auth::attempt($request->only('email', 'password')))
            return redirect('dashboard')->with('msg', 'You are logged in');

        return redirect("login")->with('msg', 'Invalid login data');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails())
            return redirect("register")->with('msg', 'Validation Error');

        $data = $request->all();
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        return redirect("dashboard")->with('msg', 'You are registered');
    }

    public function dashboard()
    {
        // if (Auth::check())
        //     return view('dashboard');
        // return redirect("login")->with('msg','Access Denied');
        return view("dashboard");
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('dashboard');
    }
}
