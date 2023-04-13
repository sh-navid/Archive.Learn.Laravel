# Laravel
## Auth and Validator
- `php artisan make:controller MyAuthController`
    - ~~~php
        <?php

        namespace App\Http\Controllers;

        use App\Models\User;
        use Illuminate\Http\Request;
        use Illuminate\Support\Facades\Auth;
        use Illuminate\Support\Facades\Hash;
        use Illuminate\Support\Facades\Session;
        use Illuminate\Support\Facades\Validator;

        class MyAuthController extends Controller
        {
            public function login(Request $request)
            {
                if (Auth::attempt($request->only('email', 'password')))
                    return redirect('dashboard')->with('msg', 'You are logged in');

                return redirect("login")->with('msg', 'Invalid login data');
            }

            public function register(Request $request)
            {
                $data = $request->all();
                User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password'])
                ]);

                return redirect("dashboard")->with('msg', 'You are registered');
            }

            public function dashboard()
            {
                return view("dashboard");
            }

            public function logout()
            {
                Session::flush();
                Auth::logout();
                return Redirect('dashboard');
            }
        }
      ~~~
- Make a view `login.blade.php`
    - ~~~php
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
      ~~~
- Make a view `register.blade.php`
    - ~~~php
        <!DOCTYPE html>
        <html lang="en">
        <body>
            <p>{{ Session::get('msg')??"" }}</p>
            <form action="/register" method="POST">
                @csrf
                <input type="text" name="name" placeholder="name"/>
                <input type="text" name="email" placeholder="email"/>
                <input type="text" name="password" placeholder="password"/>
                <input type="submit" value="Register"/>
            </form>
        </body>
        </html>
      ~~~
- Make a view `dashboard.blade.php`
    - ~~~php
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
                <br/>
                <a href="/logout">Logout</a>
            @endguest
        </body>
        </html>
      ~~~
- Routers in `web.php`
    - ~~~php
        Route::view('login',     'login');
        Route::view('register',  'register');

        Route::get('dashboard',  [MyAuthController::class, 'dashboard']);
        Route::get('logout',     [MyAuthController::class, 'logout']);

        Route::post('login',     [MyAuthController::class, 'login']);
        Route::post('register',  [MyAuthController::class, 'register']);
      ~~~
- Extended controller with validators
    - ~~~php
        <?php

        namespace App\Http\Controllers;

        use App\Models\User;
        use Illuminate\Http\Request;
        use Illuminate\Support\Facades\Auth;
        use Illuminate\Support\Facades\Hash;
        use Illuminate\Support\Facades\Session;
        use Illuminate\Support\Facades\Validator;

        class MyAuthController extends Controller
        {
            public function login(Request $request)
            {
                $validator = Validator::make($request->all(), [
                    'email' => 'required',
                    'password' => 'required',
                ]);

                if ($validator->fails())
                    return redirect("login")->with('msg', 'Validation Error');

                if (Auth::attempt($request->only('email', 'password')))
                    return redirect('dashboard')->with('msg', 'You are logged in');

                return redirect("login")->with('msg', 'Invalid login data');
            }

            public function register(Request $request)
            {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6'
                ]);

                if ($validator->fails())
                    return redirect("register")->with('msg', 'Validation Error');

                $data = $request->all();
                User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password'])
                ]);

                return redirect("dashboard")->with('msg', 'You are registered');
            }

            public function dashboard()
            {
                // if (Auth::check())
                //     return view('dashboard');
                // return redirect("login")->with('msg','Access Denied');
                return view("dashboard");
            }

            public function logout()
            {
                Session::flush();
                Auth::logout();
                return Redirect('dashboard');
            }
        }
      ~~~
- We can also access to user data from `Auth` in view
    - ~~~php
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
      ~~~