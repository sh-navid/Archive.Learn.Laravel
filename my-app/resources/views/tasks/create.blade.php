@extends('tasks.layout')

@section('content')
    <h1>CREATE</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Title">
        <input type="submit" value="Create">
    </form>
@endsection