# Laravel
## Route
- `web.php`
    - Provides features like `session state` and `CSRF` protection [more](https://laravel.com/docs/5.6/routing).
    - To make a route; Go to `routes/web.php`
    - Append this code example
        ~~~php
        Route::get('/home', function(){
            return "<h1>Home Page</h1>";
        });
        ~~~
    - Call it like this:
        - `http://127.0.0.1:8000/home`
    - We also have
        - `Route::post()`
        - `Route::put()`
        - `Route::patch()`
        - `Route::delete()`
    - Lets have a view
    - Go to `resources/views`
    - Make a view and call it `about.blade.php`
    - Then, Go to `routes/web.php`
        ~~~php
            Route::get('/about', function () {
                return view("about");
            });
        ~~~
    - Call this address like this:
        - `http://127.0.0.1:8000/about`
- `api.php`
    - To make API route; Go to `routes/api.php`
    - Append this code example
        ~~~php
        Route::get("/hello", function () {
            return "This is our simple hello API";
        });
        ~~~
    - Call it like this:
        - `http://127.0.0.1:8000/api/hello`