<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

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
