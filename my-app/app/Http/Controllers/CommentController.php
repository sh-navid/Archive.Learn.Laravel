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

    public function store(Request $request)
    {
        Comment::create($request->all());
        return redirect()->route("comments.index");
    }

    public function update(Request $request, Comment $comment)
    {
        $comment->update($request->all());
    }

    public function destroy(Comment $comment)
    {
        $id = $comment->id;
        $comment->delete();
        return $id;
    }
}
