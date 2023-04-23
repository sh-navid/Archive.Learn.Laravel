# Laravel
## Middleware
- Make a middleware
    - `php artisan make:middleware AuthMiddleware`
- Change Middleware
    - ~~~php
        class AuthMiddleware
        {
            public function handle(Request $request, Closure $next): Response
            {
                if (Auth::check()) {
                    return $next($request);
                } else {
                    Auth::logout();
                    return redirect("login");
                }
            }
        }
      ~~~
- Register middleware in kernel `App\Http\Kernel.php`
    - This section may not be present in this file
        - Make it if so...
    - ~~~php
        protected $routeMiddleware = [
            'auth.mid' => AuthMiddleware::class
        ];
      ~~~
- Use middleware in routes
    - ~~~php
        Route::get('/', function () {
            return redirect('/home');
        });

        Route::middleware("auth.mid")->get('/home', function () {
            return view('home');
        });

        Route::get('/login', function () {
            if (Auth::check())
                return redirect("home");
            return view('login');
        });
      ~~~