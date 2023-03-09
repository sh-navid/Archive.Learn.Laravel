# Laravel
## CSR Project
- `php artisan make:migration create_comments_table --create comments`
- ~~~php
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments("id");
            $table->string("email");
            $table->string("content");
            $table->timestamps();
        });
    }
  ~~~
- `php artisan migrate:status`
- `php artisan migrate`
- `php artisan migrate:status`
- `php artisan make:model Comment`
- `php artisan make:seeder CommentSeeder`
- ~~~php
    public function run()
    {
        Comment::create(["email" => "admin@hello.world", "content" => "Hello to all"]);
    }
  ~~~
- `php artisan db:seed --class=CommentSeeder`
- `php artisan make:controller CommentController --resource --model=Comment`
- Append `Route::resource("/comments",CommentController::class);` to `web.php`
- ~~~php

  ~~~
- Make `index.blade.php`
  ~~~php

  ~~~