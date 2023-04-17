<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Candy Market Home</title>
    <script
              src="https://code.jquery.com/jquery-3.6.4.min.js"
              integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
              crossorigin="anonymous">
    </script>
</head>
<body>
    @guest
        <h1>Guest</h1>
        <a href="/login">Login</a> | 
        <a href="/register">Register</a>
    @else
        @if (Auth::user()["role"]==2)
            <h1>Admin</h1>
        @else
            <h1>User</h1>
        @endif
        <a href="/logout">Logout</a>
    @endguest
</body>
</html>