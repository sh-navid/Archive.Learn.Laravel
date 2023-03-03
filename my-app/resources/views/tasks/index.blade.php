@extends('tasks.layout')

@section('content')
    <h1>INDEX</h1>

    <p>{{ Session::get('msg')??"" }}</p>

    <a href="{{ route('tasks.create') }}">New</a>
    
    <hr/>

    @foreach ($tasks as $task)
        <h3>{{$task->title}}</h3>    

        <form action="{{ route('tasks.destroy',$task->id) }}" method="POST">
            <a href="{{ route('tasks.show',$task->id) }}">Show</a>
            <a href="{{ route('tasks.edit',$task->id) }}">Edit</a>

            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @endforeach
@endsection