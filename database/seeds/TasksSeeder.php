<?php

  use Illuminate\Database\Seeder;
  use App\Models\Task;

  class TasksSeeder extends Seeder
  {
    public function run()
    {
      factory(Task::class, 50)->create();
    }
  }
