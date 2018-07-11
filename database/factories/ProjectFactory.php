<?php

  use Faker\Generator as Faker;
  use App\Models\Project;

  $factory->define(Project::class, function (Faker $faker) {
      return [
        'name' => $faker->word,
        'user_id' => $faker->numberBetween(3, 4)
      ];
  });
