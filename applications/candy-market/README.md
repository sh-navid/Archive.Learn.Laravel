# Laravel
## Candy Market
- Make a new empty laravel project
- Config database `password` in `.env` file
- Make a model `Candy`
    - `php artisan make:model Candy -m`
- Go to candy migration:
    - ~~~php
        // This is not the best data model; this is just for teaching and learning
        Schema::create('candies', function (Blueprint $table) {
            $table->id();
            $table->string("image");
            $table->string("title");
            $table->text("description");
            $table->integer("price"); //2500T
            $table->integer("amount"); //12
            $table->integer("type"); //1 KG, 2 Piece, 3 box
            $table->timestamps();
            $table->foreignIdFor(User::class)->constrained();
        });
      ~~~
    - `php artisan migrate`
    - `php artisan migrate:fresh`
    - Also update `Candy` model like this:
    - ~~~php
        protected $fillable = [
            'image',
            'title',
            'description',
            'price',
            'amount',
            'type',
            'user_id'
        ];
      ~~~
- Update user migration like this:
    - ~~~php
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->unique();
            $table->string('password');
            $table->integer('role')->default(1); // 1 = normal user, 2 = admin
            $table->rememberToken();
            $table->timestamps();
        });
      ~~~
    - `php artisan migrate:fresh`
    - Also update `User` model like this:
    - ~~~php
        protected $fillable = [
            'phone',
            'password',
            'role',
        ];
      ~~~
- Create a command to seed a default admin user
    - `php artisan make:command MakeAdminUser`
    - ~~~php
        class MakeAdminUser extends Command
        {
            protected $signature = 'make:admin-user';
            protected $description = 'To make default admin user';

            public function handle()
            {
                User::create(["phone" => "123", "password" => Hash::make("123"), "role" => "2"]);
            }
        }
      ~~~
    - `php artisan make:admin-user`
- Make `register.blade.php`
    - ~~~php
        <form action="/register" method="POST">
            @csrf
            <input type="text" name="phone" placeholder="Phone" required/>
            <input type="password" name="password" placeholder="Password" required/>
            <input type="submit" value="Register">
        </form>
      ~~~
    - Also in `web.php`
        - ~~~php
            Route::view("/register", "register");
            Route::post("/register", function (Request $request) {
                $request["password"] = Hash::make($request['password']);
                User::create($request->all());
                return redirect("login");
            });
          ~~~
- Make `login.blade.php`
    - ~~~php
        <form action="/login" method="POST">
            @csrf
            <input type="text" name="phone" placeholder="Phone" required/>
            <input type="password" name="password" placeholder="Password" required/>
            <input type="submit" value="Login">
        </form>
      ~~~
    - Also in `web.php`
        - ~~~php
            Route::view("/login", "login");
            Route::post("/login", function (Request $request) {
                if (Auth::attempt($request->only('phone', 'password')))
                    return redirect('home');
                return redirect("login");
            });

            Route::get("/logout", function () {
                Session::flush();
                Auth::logout();
                return Redirect('home');
            });
          ~~~
- Make `create.blade.php` to create new candy post
    - ~~~php
        <form action="/create" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="imagefile" required/>
            <input type="text" name="title" placeholder="title" required/>
            <input type="text" name="description" placeholder="description" required/>
            <input type="number" name="price" placeholder="price" required/>
            <input type="number" name="amount" placeholder="amount" required/>
            <select name="type" id="type" required>
                <option value="1">KG</option>
                <option value="2">Piece</option>
                <option value="3">Box</option>
            </select>
            <input type="submit" value="Create">
        </form>
      ~~~
    - Also in `web.php`
        - ~~~php
            Route::view("/create", "create");
            Route::post("/create", function (Request $request) {
                if (!Auth::check() || (Auth::check() and Auth::user()->role != 2))
                    return "<h1>Forbidden Action</h1>";
                $file = $request->file('imagefile');
                $uid=(string) Str::uuid().".".$file->getClientOriginalExtension();
                $file->move('uploads', $uid);
                $request["image"] = $uid;
                $request["user_id"] = Auth::user()->id;
                Candy::create($request->all());
                return redirect('home');
            });
          ~~~
- Make `home.blade.php`
    - ~~~php
        <body>
            @guest
                <h1>Guest</h1>
                <a href="/login">Login</a> | 
                <a href="/register">Register</a>
            @else
                @if (Auth::user()["role"]==2)
                    <h1>Admin</h1>
                    <a href="/create">Create</a>
                @else
                    <h1>User</h1>
                @endif
                <a href="/logout">Logout</a>
            @endguest

            @php
                const TYPES=[1=>"KG",2=>"دونه",3=>"جعبه"]   
            @endphp

            @foreach ($candies as $candy)
                <h3>{{$candy->title}}</h3>
                <p>{{$candy->desc}}</p>
                <h5>Amount {{$candy->amount}} {{TYPES[$candy->type]}}</h5>
                <h5>Price {{$candy->price}} Rials</h5>
                <img src="{{url('/uploads/'.$candy->image)}}" alt="">
                @if (Auth::user()!=null && Auth::user()["role"]==1)
                <button>Add to basket</button>
                @endif
                <hr/>
            @endforeach
        </body>
      ~~~
    - Also in `web.php`
        - ~~~php
            Route::get('/', function () {
                return redirect("/home");
            });

            Route::get('/home', function () {
                $candies = Candy::all();
                return view('home', compact("candies"));
            });
          ~~~
- Make `basket.blade.php` as a shopping basket
    - ~~~php

      ~~~
    - Also in `web.php`
        - ~~~php

          ~~~