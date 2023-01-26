# Laravel
***Disclaimer*: The content described in this article are for educational purposes only.**
---
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
    - Lets pass URL parameter to our Blade view
    - Go to `resources/views`
    - Make a view and call it `test.blade.php` and fill it like this
        ~~~html
        <!DOCTYPE html>
        <html lang="en">
        <body>
            <h1>Test Page To Show Get URL Params</h1>
            <p>{{request("name")}}</p>
        </body>
        </html>
        ~~~
    - Go to `resources/views` and make another route like this one
        ~~~php
        Route::get('/test/{name}', function ($name) {
            return view("test");
        });
        ~~~
    - And finally call it like this: `http://127.0.0.1:8000/test/david`
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
    - Let make API with required parameters
        ~~~php
        Route::get("/hi/{name}", function ($name) {
            return "Hello " . $name;
        });
        ~~~
        - Call: `http://127.0.0.1:8000/api/hi/david`
    - Let make API with Optional parameters
        ~~~php
        Route::get("/bye/{name?}", function ($name = "") {
            return "Bye " . $name;
        });
        ~~~
        - Call: `http://127.0.0.1:8000/api/bye`
        - Call: `http://127.0.0.1:8000/api/bye/david`
- Any and Match
    ~~~php
    Route::match(['get', 'post'], '/match', function () {
        return "Route Match";
    });
    ~~~
 
    ~~~php
    Route::any('/any', function () {
        return "Route Any";
    });
    ~~~
- Redirect
    - `Route::redirect('/root', '/home', 301);`
    - [`301` error code ](https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/301) means Moved Permanently.