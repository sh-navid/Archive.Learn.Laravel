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
 
class Task extends Model
{
    protected $table = 'my_tasks';
    protected $primaryKey = 'my_id';
    public $incrementing = false;
    public $timestamps = false; // means do not create created_at and updated_at columns

    // set default values
    protected $attributes = [
        'name' => "Unset",
    ];
}
~~~





