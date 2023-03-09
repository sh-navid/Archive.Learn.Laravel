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