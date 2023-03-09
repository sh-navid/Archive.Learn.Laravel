<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view("index", compact("comments"));
    }

    public function create()
    {
        // return view
    }

    public function store(Request $request)
    {
        return Comment::create($request->all());
    }

    public function show(Comment $comment)
    {
        // return view
    }

    public function edit(Comment $comment)
    {
        // return view
    }

    public function update(Request $request, Comment $comment)
    {
        return $comment->update($request->all());
    }

    public function destroy(Comment $comment)
    {
        return $comment->delete();
    }
}
