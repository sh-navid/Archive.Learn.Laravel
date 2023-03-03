@extends('tasks.layout')

@section('content')
    <h1>EDIT</h1>

    <form action="{{ route('tasks.update',$task->id) }}" method="POST">
        @csrf
        @method('PUT')
   
        <input type="text" name="title" value="{{ $task->title }}" placeholder="Title">
        <input type="checkbox" name="is_done" {{ $task->is_done ? 'checked' : '' }}>
        <input type="submit" value="Update">
    </form>
@endsection