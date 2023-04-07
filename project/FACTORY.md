# Laravel
## Factory
- `php artisan make:Model Cake -m`
    - Go to `migration` and fill
        - ~~~php
            public function up()
            {
                Schema::create('cakes', function (Blueprint $table) {
                    $table->id();
                    $table->string("name");
                    $table->integer("price");
                    $table->timestamps();
                });
            }
        ~~~
- `php artisan migrate`
- `php artisan make:factory CakeFactory --model=Cake`
- Go to `database/factories/CakeFactory.php`
    - ~~~php
        class CakeFactory extends Factory
        {
            public function definition()
            {
                return [
                    'name' => $this->faker->unique()->word(),
                    'price' => $this->faker->numberBetween(1000, 3000)
                ];
            }
        }
      ~~~
- `php artisan make:command cakeCommand`
- Go to `app/Console/Commands/cakeCommand.php`
    - ~~~php
        use App\Models\Cake;
        use Illuminate\Console\Command;

        class cakeCommand extends Command
        {
            protected $signature = 'create:cake {number}';

            protected $description = 'To make fake users';

            public function handle()
            {
                $number = $this->argument("number");
                Cake::factory()->count($number)->create();
                return Command::SUCCESS;
            }
        }
      ~~~
- `php artisan create:cake 10`