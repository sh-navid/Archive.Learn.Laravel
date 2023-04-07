<?php

namespace App\Console\Commands;

use App\Models\Cake;
use Illuminate\Console\Command;

class cakeCommand extends Command
{
    protected $signature = 'create:cake {number}';

    protected $description = 'To make fake users';

    public function handle()
    {
        $number = $this->argument("number");
        Cake::factory()->count($number)->make();
        return Command::SUCCESS;
    }
}
