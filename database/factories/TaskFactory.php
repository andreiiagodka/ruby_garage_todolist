<?php

  use Faker\Generator as Faker;
  use App\Models\Task;

  $factory->define(Task::class, function (Faker $faker) {
    return [
      'name' => $faker->word,
      'status' => $faker->boolean(10),
      'project_id' => $faker->numberBetween(1, 200)
    ];
  });
