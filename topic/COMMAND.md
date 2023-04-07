# Laravel
## CustomCommand
- Show all commands
    - `php artisan list`
- `php artisan make:command myCommand`
- Go to `app/Console/Commands/myCommand.php`
    - ~~~php
        use App\Models\User;
        use Illuminate\Console\Command;

        class myCommand extends Command
        {
            protected $signature = 'create:fakeuser {number}';

            protected $description = 'To make fake users';

            public function handle()
            {
                $number = $this->argument("number");
                for ($i = 0; $i < $number; $i++) {
                    User::factory()->create();
                }
                return Command::SUCCESS;
            }
        }
      ~~~
- `php artisan create:fakeuser 10`