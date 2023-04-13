<!DOCTYPE html>
<html lang="en">
<body>
    <h1>DASHBOARD</h1>
    <p>{{ Session::get('msg')??"" }}</p>
    @guest
        Guest
        <br/>
        <a href="/login">Login</a>
        <br/>
        <a href="/register">Register</a>
    @else
        Admin
        {{Auth::user()}}
        {{Auth::id()}}
        <br/>
        <a href="/logout">Logout</a>
    @endguest
</body>
</html>