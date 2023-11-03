<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    const TASK_COUNT = 10;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::factory(self::TASK_COUNT)->create();
    }
}
