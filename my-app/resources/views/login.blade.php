<!DOCTYPE html>
<html lang="en">
<body>
    <p>{{ Session::get('msg')??"" }}</p>
    <form action="/login" method="POST">
        @csrf
        <input type="text" name="email" placeholder="email"/>
        <input type="text" name="password" placeholder="password"/>
        <input type="submit" value="login"/>
    </form>
</body>
</html>