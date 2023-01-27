<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return "<h1>[INDEX]</h1>";
    }

    public function create()
    {
        return "<h1>[CREATE]</h1>";
    }

    public function store(Request $request)
    {
        return "<h1>[STORE]</h1>";
    }

    public function show($id)
    {
        return "<h1>[SHOW $id]</h1>";
    }

    public function edit($id)
    {
        return "<h1>[EDIT $id]</h1>";
    }

    public function update(Request $request, $id)
    {
        return "<h1>[UPDATE $id]</h1>";
    }

    public function destroy($id)
    {
        return "<h1>[DESTROY $id]</h1>";
    }
}
