<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Candy Market Home</title>
</head>
<body>
    @guest
        <h1>Guest</h1>
    @else
        @if (Auth::user()["role"]==1)
            <h1>Admin</h1>
        @else
            <h1>User</h1>
        @endif
    @endguest
</body>
</html>