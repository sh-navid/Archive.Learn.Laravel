<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

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
