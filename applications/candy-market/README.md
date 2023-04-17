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
- Make `login.blade.php`
    - ~~~php
        <form action="/login" method="POST">
            @csrf
            <input type="text" name="phone" placeholder="Phone" required/>
            <input type="password" name="password" placeholder="Password" required/>
            <input type="submit" value="Login">
        </form>
      ~~~
- Make `create.blade.php` to create new candy post
    - ~~~php

      ~~~
- Make `home.blade.php`
    - ~~~php

      ~~~
- Make `basket.blade.php` as a shopping basket
    - ~~~php

      ~~~