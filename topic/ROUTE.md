# Laravel
## Route
- Go to `routes/web.php`
- Append this code example
    ~~~php
    Route::get('/home', function(){
        return "<h1>Home Page</h1>";
    });
    ~~~
- Call it like this:
    - `http://127.0.0.1:8000/home`