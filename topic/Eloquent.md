# Laravel
## Eloquent
### Foreign Id, Join
- Make both model and migration for `Post`
    - `php artisan make:model Post -m`
    - ~~~php
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("desc");
            $table->timestamps();
            $table->foreignIdFor(User::class)->constrained();
        });
      ~~~
- Revert all migrations and then run them again.
    - `php artisan migrate:fresh`
- Make command to create fake users
    - `php artisan make:command fakeUserCommand`
    - ~~~php
        class fakeUserCommand extends Command
        {
            protected $signature = 'fake:user';
            protected $description = 'Command description';

            public function handle()
            {
                User::factory()->count(5)->create();
                return Command::SUCCESS;
            }
        }
      ~~~
      - `php artisan fake:user`
- Make factory to create posts
    - `php artisan make:factory PostFactory --model=Post`
        - ~~~php
            public function definition()
            {
                $x = fake()->numberBetween(1, 10000);
                return [
                    'title' => "Post " . $x,
                    'desc' => "Desc " . $x,
                    'user_id' => fake()->numberBetween(1, 5),
                ];
            }
          ~~~
    - `php artisan make:command fakePostCommand`
        - ~~~php
            class fakePostCommand extends Command
            {
                protected $signature = 'fake:post';
                protected $description = 'Command description';

                public function handle()
                {
                    Post::factory()->count(5)->create();
                    return Command::SUCCESS;
                }
            }
          ~~~
    - `php artisan fake:post`
- Make a controller to show joined users and posts
    - `php artisan make:controller JoinController`
        - ~~~php
            class JoinController extends Controller
            {
                function join(){
                    return User::join("posts","users.id","=","posts.user_id")->get(["users.name","posts.title"]);
                }

                function where()
                {
                    return User::join("posts", "users.id", "=", "posts.user_id")->where("users.id", 1)->get(["users.name", "posts.title"]);
                }
            }
          ~~~
- Make a route in `web.php`
    - `Route::get('/join',  [JoinController::class,'join']);`
    - `Route::get('/where',  [JoinController::class,'where']);`