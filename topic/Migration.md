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

- Call this command
    - `php artisan migrate:status`
- Then call rollback
    - `php artisan migrate:rollback`
    - And aftr calling `rollback` then call `status` again
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



- Read more
    - https://laravel.com/docs/5.5/migrations
    - https://laravel.com/docs/7.x/migrations