<?php

  use Illuminate\Database\Seeder;
  use App\Models\Project;

  class ProjectsSeeder extends Seeder
  {
    public function run()
    {
      factory(Project::class, 6)->create();
    }
  }
