<?php

namespace App\Console\Commands;

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
