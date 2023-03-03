# Laravel
## Project
- `php artisan make:migration create_tasks_table --create tasks`
- ~~~php
    return new class extends Migration
    {
        public function up()
        {
            Schema::create('tasks', function (Blueprint $table) {
                $table->increments("id"); // ->id()
                $table->string("title");
                $table->boolean("is_done");
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('task');
        }
    };
  ~~~
- `php artisan migrate`
- `php artisan make:model Task`
- `php artisan make:seeder TaskSeeder`
- ~~~php
    class TaskSeeder extends Seeder
    {
        public function run()
        {
            Task::create(["title" => "Task 1", "is_done" => false]);
            Task::create(["title" => "Task 2", "is_done" => false]);
            Task::create(["title" => "Task 3", "is_done" => true]);
        }
    }
  ~~~
- `php artisan db:seed --class=TaskSeeder`
- `php artisan make:controller TaskController --resource --model=Task`