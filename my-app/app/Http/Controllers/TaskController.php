<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Display a listing of the resource.
    // http://127.0.0.1:8000/tasks
    public function index()
    {
        $tasks = Task::all();
        return view("tasks.index", compact('tasks'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view("tasks.create");
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        //
    }

    // Display the specified resource.
    public function show(Task $task)
    {
        return view("tasks.show", compact("task"));
    }

    // Show the form for editing the specified resource.
    public function edit(Task $task)
    {
        return view("tasks.edit", compact("task"));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Task $task)
    {
        //return $request->all();
        $request["is_done"] = $request["is_done"] == "on" ? 1 : 0;
        $task->update($request->all());
        return redirect()->route("tasks.index")->with("msg", "Task Updated");
    }

    // Remove the specified resource from storage.
    public function destroy(Task $task)
    {
        // Task::destroy($task->id);
        $task->delete();
        return redirect()->route("tasks.index")->with("msg", "Task Removed");
    }
}
