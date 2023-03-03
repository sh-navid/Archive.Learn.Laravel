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
- Make Layout
    - `resources/views/users/layout.blade.php`
    - ~~~php
        <html>
        <head>
            <title>Task Manager Application</title>
        </head>
        <body>
            <a href="{{ route('tasks.index') }}">Home Page</a>
        <div class="container">
            @yield('content')
        </div>
        
        </body>
        </html>
      ~~~
- Make Index
    - Task Controller Index
        - ~~~php
            public function index()
            {
                $tasks = Task::all();
                return view("tasks.index",compact('tasks'));
            }

            public function destroy(Task $task)
            {
                // Task::destroy($task->id);
                $task->delete();
                return redirect()->route("tasks.index")->with("msg", "Task Removed");
            }
        ~~~
    - `resources/views/users/index.blade.php`
        - ~~~php
            @extends('tasks.layout')

            @section('content')
                <h1>INDEX</h1>

                <p>{{ Session::get('msg')??"" }}</p>

                <a href="{{ route('tasks.create') }}">New</a>
                
                <hr/>

                @foreach ($tasks as $task)
                    <h3>{{$task->title}}</h3>    

                    <form action="{{ route('tasks.destroy',$task->id) }}" method="POST">
                        <a href="{{ route('tasks.show',$task->id) }}">Show</a>
                        <a href="{{ route('tasks.edit',$task->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                @endforeach
            @endsection
          ~~~
- Make Create
    - Task Controller Create
        - ~~~php
            public function create()
            {
                return view("tasks.create");
            }

            public function store(Request $request)
            {
                Task::create($request->all());
                return redirect()->route("tasks.index")->with("msg", "Task Created");
            }
          ~~~
    - `resources/views/users/create.blade.php`
        - ~~~php
            @extends('tasks.layout')

            @section('content')
                <h1>CREATE</h1>

                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <input type="text" name="title" placeholder="Title">
                    <input type="submit" value="Create">
                </form>
            @endsection
          ~~~
- Make Edit
    - Task Controller Edit
        - ~~~php
            public function edit(Task $task)
            {
                return view("tasks.edit", compact("task"));
            }

            public function update(Request $request, Task $task)
            {
                //return $request->all();
                $request["is_done"] = $request["is_done"] == "on" ? 1 : 0;
                $task->update($request->all());
                return redirect()->route("tasks.index")->with("msg", "Task Updated");
            }
          ~~~
    - `resources/views/users/edit.blade.php`
        - ~~~php
            @extends('tasks.layout')

            @section('content')
                <h1>EDIT</h1>

                <form action="{{ route('tasks.update',$task->id) }}" method="POST">
                    @csrf
                    @method('PUT')
            
                    <input type="text" name="title" value="{{ $task->title }}" placeholder="Title">
                    <input type="checkbox" name="is_done" {{ $task->is_done ? 'checked' : '' }}>
                    <input type="submit" value="Update">
                </form>
            @endsection
          ~~~
- Make Show
    - Task Controller Show
        - ~~~php
            public function show(Task $task)
            {
                return view("tasks.show", compact("task"));
            }
          ~~~
    - `resources/views/users/show.blade.php`
        - ~~~php
            @extends('tasks.layout')

            @section('content')
                <h1>SHOW</h1>

                {{$task->id}} - {{$task->title}} - {{$task->is_done}}
            @endsection
          ~~~
- Finally
    - Run `http://127.0.0.1:8000/tasks`