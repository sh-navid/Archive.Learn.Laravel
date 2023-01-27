# Laravel
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
        // http://127.0.0.1:8000/book
        // Method GET
        public function index()
        {
            return "<h1>[INDEX]</h1>";
        }

        // http://127.0.0.1:8000/book/create
        // Method GET
        public function create()
        {
            return "<h1>[CREATE]</h1>";
        }

        // http://127.0.0.1:8000/book
        // Method POST
        public function store(Request $request)
        {
            return "<h1>[STORE]</h1>";
        }

        // http://127.0.0.1:8000/book/2
        // Method GET
        public function show($id)
        {
            return "<h1>[SHOW $id]</h1>";
        }

        // http://127.0.0.1:8000/book/2/edit
        // Method GET
        public function edit($id)
        {
            return "<h1>[EDIT $id]</h1>";
        }

        // http://127.0.0.1:8000/book/2
        // Method PUT/PATCH
        public function update(Request $request, $id)
        {
            return "<h1>[UPDATE $id]</h1>";
        }

        // http://127.0.0.1:8000/book/2
        // Method DELETE
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
## Connect to Resource Controller
- Make a view and name it `book.blade.php` with this content:
    ~~~blade
    <form method="POST" action="{{route("book.destroy",0)}}">
        <input type="submit" value="Delete"/>
        @csrf
        @method('DELETE')
    </form>

    <form method="POST" action="{{route("book.update",0)}}">
        <input type="submit" value="Update"/>
        @csrf
        @method('PUT')
    </form>

    <form method="GET" action="{{route("book.show",0)}}">
        <input type="submit" value="Show"/>
    </form>

    <form method="GET" action="{{route("book.edit",0)}}">
        <input type="submit" value="Edit"/>
    </form>

    <form method="GET" action="{{route("book.create")}}">
        <input type="submit" value="Create"/>
    </form>

    <form method="GET" action="{{route("book.index")}}">
        <input type="submit" value="Index"/>
    </form>

    <form method="POST" action="{{route("book.store")}}">
        <input type="submit" value="Store"/>
        @csrf
        {{-- Remove CSRF Token to see 419 | Page Expired error --}}
    </form>
    ~~~
- Add a route for our view:
    ~~~php
    Route::get('/show', function () {
        return view("book");
    });
    ~~~
## Add Custom Function to Resource Controller
- [ ] FIXME: this method is not working
- Expand `BookController.php` and include these functions:
    ~~~php
    // Customs functions
    // book/title/12
    // Method GET 
    public function getTitle($id){
        return "<h1>[TITLE for $id]</h1>";
    }

    // Customs functions
    // book/data/12
    // Method POST 
    public function postData($id){
        return "<h1>[DATA for $id]</h1>";
    }
    ~~~
- Add new route
    ~~~php
    use App\Http\Controllers\BookController;
    Route::resource("/book", BookController::class); // For default CRUD
    Route::controller("/book", BookController::class); // For Custom Controllers
    ~~~
___
- [ ] TODO: read more about this [here](https://magecomp.com/blog/crud-operation-laravel-8/) 
- `php artisan make:controller UserController --resource --model=User`