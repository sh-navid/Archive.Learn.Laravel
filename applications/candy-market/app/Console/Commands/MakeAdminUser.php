<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeAdminUser extends Command
{
    protected $signature = 'make:admin-user';
    protected $description = 'To make default admin user';

    public function handle()
    {
        User::create(["phone" => "123", "password" => Hash::make("123"), "role" => "2"]);
    }
}
