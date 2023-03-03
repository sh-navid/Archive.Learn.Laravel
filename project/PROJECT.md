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
                $table->boolean("is_done")->default(false);
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
    - ~~~php
        class Task extends Model
        {
            use HasFactory;

            // To update columns
            protected $fillable = [
                'title',
                'is_done'
            ];
        }
      ~~~
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
- Append this to `web.php`
    - `Route::resource("/tasks",TaskController::class);`
- Make
    - `resources/views/users/layout.blade.php`
    - ~~~php
        <html>
        <head>
            <title>Task Manager Application</title>
        </head>
        <body>
        
        <div class="container">
            @yield('content')
        </div>
        
        </body>
        </html>
      ~~~
- Make
    - Task Controller
        - ~~~php
            public function index()
            {
                $tasks = Task::all();
                return view("tasks.index",compact('tasks'));
            }
        ~~~
    - `resources/views/users/index.blade.php`
        - ~~~php
        
          ~~~
- Make
    - Task Controller
        - ~~~php

          ~~~
    - `resources/views/users/create.blade.php`
        - ~~~php
        
          ~~~
- Make
    - Task Controller
        - ~~~php

          ~~~
    - `resources/views/users/edit.blade.php`
        - ~~~php
        
          ~~~
- Make
    - Task Controller
        - ~~~php

          ~~~
    - `resources/views/users/show.blade.php`
        - ~~~php
        
          ~~~
- Finally
    - Run `http://127.0.0.1:8000/tasks`