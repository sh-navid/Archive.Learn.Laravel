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
            $table->integer('role'); // 1 = normal user, 2 = admin
            $table->rememberToken();
            $table->timestamps();
        });
      ~~~
    - `php artisan migrate:fresh`
- Make `register.blade.php`
    - ~~~php

      ~~~
- Make `login.blade.php`
    - ~~~php

      ~~~
- Make `create.blade.php`
    - ~~~php

      ~~~
- Make `home.blade.php`
    - ~~~php

      ~~~
- Make `dashboard.blade.php`
    - ~~~php

      ~~~
- Make `shop-basket.blade.php`
    - ~~~php

      ~~~