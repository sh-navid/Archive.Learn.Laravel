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
>> Middleware provide a convenient mechanism for inspecting and filtering HTTP requests entering your application. For example, Laravel includes a middleware that verifies the user of your application is authenticated. If the user is not authenticated, the middleware will redirect the user to your application's login screen. However, if the user is authenticated, the middleware will allow the request to proceed further into the application. <sup>[laravel Jan27](https://laravel.com/docs/9.x/middleware)</sup> 
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
## Restful Resource Controllers
- We can use a single route for CRUD (Create, Read, Update, Delete) operations.
- Make a new controller with this command
    - `php artisan make:controller BookController --resource`
- Change controller content like this
    ~~~php
    class BookController extends Controller
    {
        public function index()
        {
            return "<h1>[INDEX]</h1>";
        }

        public function create()
        {
            return "<h1>[CREATE]</h1>";
        }

        public function store(Request $request)
        {
            return "<h1>[STORE]</h1>";
        }

        public function show($id)
        {
            return "<h1>[SHOW $id]</h1>";
        }

        public function edit($id)
        {
            return "<h1>[EDIT $id]</h1>";
        }

        public function update(Request $request, $id)
        {
            return "<h1>[UPDATE $id]</h1>";
        }

        public function destroy($id)
        {
            return "<h1>[DESTROY $id]</h1>";
        }
    }
    ~~~
- And update router like this:
    ~~~php
    use App\Http\Controllers\BookController;
    Route::resource("/book", BookController::class);
    ~~~
___
- [ ] TODO: read more about this [here](https://magecomp.com/blog/crud-operation-laravel-8/) 