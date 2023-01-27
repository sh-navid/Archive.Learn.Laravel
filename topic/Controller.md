# CSRF
***Disclaimer*: The content described in this article are for educational purposes only.**
---
## Controller
- To make a controller
    - `php artisan make:controller HelloController`
- This will create a controller in `app/Http/Controllers`
- Change this controller like this:
    ~~~php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    class HelloController extends Controller
    {
        public function say(Request $request)
        {
            echo '<br/>URL: ' . $request->url();
            echo '<br/>URI: ' . $request->path();
            echo '<br/>Method: ' . $request->method();
        }
    }
    ~~~
- Add a route for this controller
    ~~~php 
    use App\Http\Controllers\HelloController;
    Route::get("/say/hello", [HelloController::class, "say"]);
    ~~~
- Browse this address `http://127.0.0.1:8000/say/hello`

## Middleware
>> Middleware acts as a bridge between a request and a response. <sup>[tutorialspoint Jan27](https://www.tutorialspoint.com/laravel/laravel_middleware.htm)</sup> 
- To make a middleware
    - `php artisan make:middleware HelloMiddleware`
- Register middleware in `App\Http\Kernel`
    ~~~php
    protected $routeMiddleware = [
        ...
        'hello' => \App\Http\Middleware\HelloMiddleware::class
        ...
    ];
    ~~~
- Update route like this:
    ~~~php
    Route::get("/say/hello", [HelloController::class, "say"])->middleware("hello");
    ~~~