<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Candy Market Register New User</title>
</head>
<body>
    <form action="/register" method="POST">
        @csrf
        <input type="text" name="phone" placeholder="Phone" required/>
        <input type="password" name="password" placeholder="Password" required/>
        <input type="submit" value="Register">
    </form>
</body>
</html>