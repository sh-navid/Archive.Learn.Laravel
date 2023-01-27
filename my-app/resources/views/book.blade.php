<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- GET, HEAD, PUT, PATCH, DELETE --}}

    <form method="POST" action="{{route("book.destroy",0)}}">
        <input type="submit" value="Delete"/>
        @csrf
        @method('DELETE')
    </form>

    <form method="POST" action="{{route("book.update",0)}}">
        <input type="submit" value="Update"/>
        @csrf
        @method('PUT')
    </form>

    <form method="GET" action="{{route("book.show",0)}}">
        <input type="submit" value="Show"/>
    </form>

    <form method="GET" action="{{route("book.edit",0)}}">
        <input type="submit" value="Edit"/>
    </form>

    <form method="GET" action="{{route("book.create")}}">
        <input type="submit" value="Create"/>
    </form>

    <form method="GET" action="{{route("book.index")}}">
        <input type="submit" value="Index"/>
    </form>

    <form method="POST" action="{{route("book.store")}}">
        <input type="submit" value="Store"/>
        @csrf
        {{-- Remove CSRF Token to see 419 | Page Expired error --}}
    </form>
</body>
</html>