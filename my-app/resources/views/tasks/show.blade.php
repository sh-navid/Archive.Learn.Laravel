@extends('tasks.layout')

@section('content')
    <h1>SHOW</h1>

    {{$task->id}} - {{$task->title}} - {{$task->is_done}}
@endsection