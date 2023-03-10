# Laravel
## Migration
***Disclaimer*: The content described in this repository are for educational purposes only.**

~~~php
public function up()
{
    Schema::create('tasks', function (Blueprint $table) {
        $table->increments('id');
        $table->string('title');
        $table->boolean('is_done');
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
- Change Column
    - ~~~php
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('title', 100)->change();
        });
    ~~~
- Rename Column
    - ~~~php
        Schema::table('tasks', function (Blueprint $table) {
            $table->renameColumn('title', 'my_title');
        });
    ~~~
- Drop Column
    - ~~~php
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('title');
        });
    ~~~
    - `$table->dropTimestamps();`
- Index
    - `$table->string('title')->unique();` or `$table->unique('title');`
        - `$table->dropUnique('title');`
    - Compund Index
        - `$table->index(['col1', 'col2']);`
            - `$table->dropIndex('something_index');`
    - Primary Key
        - `$table->primary('id');`
            - `$table->dropPrimary('id');`
        - `$table->primary(['col1', 'col2']);`
    - Rename Index
        - `$table->renameIndex('from', 'to');`
- Foreign Key Constraints
    - ~~~php
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->boolean('is_done');
            $table->timestamps();

            $table->unsignedBigInteger('color_id');
            $table->foreign('color_id')->references('id')->on('colors');
        });   
      ~~~
    - We can change
        - `$table->unsignedBigInteger('color_id');`
        - `$table->foreign('color_id')->references('id')->on('colors');`
    - to
        - `$table->foreignId('color_id')->constrained('colors');`
    - And also
        - ~~~php
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
          ~~~
        - Other options
            - `$table->cascadeOnUpdate();`, `$table->restrictOnUpdate();`, `$table->cascadeOnDelete();`, `$table->restrictOnDelete();`, `$table->nullOnDelete();`
    - Drop
        - `$table->dropForeign('color_id');`


- Read more
    - https://laravel.com/docs/5.5/migrations
    - https://laravel.com/docs/7.x/migrations