# Laravel
## Migration
***Disclaimer*: The content described in this repository are for educational purposes only.**

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
- `php artisan make:migration create_tasks_table`
___
- Make a new sql file in `schema/mysql-schema.sql` to renew all tables
    - `php artisan schema:dump`
- Previous process + Remove migration files
    - `php artisan schema:dump --prune`

- Status
    - `php artisan migrate:status`
- Rollback
    - `php artisan migrate:rollback`
    - And after calling `rollback` then call `status` again
    - `php artisan migrate:rollback --step=3`
- Rollback and migrate
    - `php artisan migrate:refresh --seed`
- Drop and migrate
    - `php artisan migrate:fresh --seed`
- Check
    - `Schema::hasTable('tasks')`
    - `Schema::hasColumn('tasks', 'id')`
- Rename table
    - `Schema::rename('tasks', 'our_tasks')`
- Drop
    - `Schema::drop('tasks')`
    - `Schema::dropIfExists('tasks');`
- Update table
    - `php artisan make:migration create_maps_table`
    - ~~~php
        Schema::create('maps', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
      ~~~
    - `php artisan migrate:status`
    - `php artisan migrate`
    - `php artisan make:migration update_maps_table`
    - ~~~php
        Schema::table('maps', function (Blueprint $table) {
            $table->string("my_col");
        });
      ~~~
    - `php artisan migrate:status`
    - `php artisan migrate`
    - Other than `string` type we have many more types like
        - `float`, `integer`, `boolean`, `char`, `date`, `decimal`, `double`, `enum`
        - `increments`
        - `foreignId`, `foreignIdFor`, `foreignUuid`
        - `ipAddress`, `json`, `set`, `uuid`, `time`, `text`, `timestamp`, ...
        - `$table->uuid('id');`
        - `$table->enum('gender', ['m', 'f']);`
        - `$table->set('colors', ['grren', 'blue']);`
    - Modifiers
        - `$table->string('name')->nullable();`
        - `$table->string('name')->default('something');`
        Place
            - `->first()`
            - `->after('col')` to place a column after another column
        - `->increments("id")->from(100)`
        - `->autoIncrement()`
        - `->invisible()` to `select *`
        - `->unsigned()`
        - `->useCurrent()` set current TIME_STAMP
        - `->useCurrentOnUpdate()`



- Read more
    - https://laravel.com/docs/5.5/migrations
    - https://laravel.com/docs/7.x/migrations