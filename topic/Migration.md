# Laravel
## Migration



~~~php
public function up()
{
    Schema::create('dictionary', function (Blueprint $table) {
        $table->increments('id');
        $table->string('word');
        $table->string('trans');
        $table->timestamps();
    });   
}
~~~

- `php artisan migrate`



- Read more
    - https://laravel.com/docs/5.5/migrations
    - https://laravel.com/docs/7.x/migrations