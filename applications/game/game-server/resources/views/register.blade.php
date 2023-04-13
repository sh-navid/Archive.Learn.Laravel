<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
    <form action="/register" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name"/>
        <input type="password" name="password" placeholder="Password"/>
        <input type="color" name="color"/>
        <input type="submit" value="Register">
    </form>
</body>
</html>