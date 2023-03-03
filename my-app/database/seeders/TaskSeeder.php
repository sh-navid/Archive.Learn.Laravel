<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::create(["title" => "Task 1", "is_done" => false]);
        Task::create(["title" => "Task 2", "is_done" => false]);
        Task::create(["title" => "Task 3", "is_done" => true]);
    }
}
