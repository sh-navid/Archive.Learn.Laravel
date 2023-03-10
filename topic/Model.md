# Laravel
## Model

- Each database table has a corresponding `Model` <sup>[eloquent 7.x](https://laravel.com/docs/7.x/eloquent)</sup>
- All Eloquent models extend `Illuminate\Database\Eloquent\Model` class <sup>[eloquent 7.x](https://laravel.com/docs/7.x/eloquent)</sup>
- `php artisan make:model Task` without migration
- `php artisan make:model Task --migration` with migration
- `php artisan make:model Task -m` with migration
- >> `artisan` not working? `composer update --no-scripts`
- If your model is `Task`; Your database table is `tasks`
- Each table has an `id` by deafult

~~~php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
 
class Task extends Model
{
    protected $table = 'my_tasks';
    protected $primaryKey = 'my_id';
    public $incrementing = false;

    // means do not create created_at and updated_at columns
    public $timestamps = false; 
    // Also to change format of timestamps
    protected $dateFormat = 'U';


    // set default values
    protected $attributes = [
        'name' => "Unset",
    ];

    // If your primary key is not integer
    // You should define its type like this
    protected $keyType = 'string';


    // Use this if you want to have UUID instead of id
    // Then just create a simple record without defining or passing an id
    // Just check the record id after creating it
    use HasUuids; // 32 chars
    // or
    use HasUlids; // 26 chars
}
~~~

- Retrieve
    - ~~~php
        foreach (Task::all() as $task) {
            echo $task->title;
        }
      ~~~
- Query
    - ~~~php
        $tasks = Task::where('is_done', 1)
                        ->orderBy('title')
                        ->take(5)
                        ->get();


        $tasks = Task::where('is_done', 1)->get();


        $task = Task::where('is_done', 1)->first();
        $task->title="new title";
        $task->refresh();
        echo $task->title; // Old Title


        $tasks = Task::cursor()->filter(function (Task $task) {
            return $task->id < 10;
        });
        
        foreach ($tasks as $task) {
            echo $task->title;
        }


        // Find a model with primary key
        $task = Task::find(1);


        $task = Task::findOr(10, function () {});


        $task = Task::findOrFail(1);
        

        $task = Task::where('id', '<', 3)->firstOr(function () {});

        
        $task = Task::where('id', '<', 3)->count();


        // Create in DB? if not exists
        $task = Task::firstOrCreate([
            'id' => 10
        ]);


        // Create instance if not exists
        $task = Task::firstOrNew([
            'id' => 10
        ]);



        // Update model
        $task = Flight::find(1);
        $task->title = 'Hello';
        $task->save();
      ~~~





