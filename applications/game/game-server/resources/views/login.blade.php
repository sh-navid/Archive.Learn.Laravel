<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
    <form action="/login" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name" required/>
        <input type="password" name="password" placeholder="Password" required/>
        <input type="submit" value="Login">
    </form>
    <a href="/register">Go to register page</a>
</body>
</html>