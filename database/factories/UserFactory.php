<?php

  use Faker\Generator as Faker;
  use App\Models\User;

  $factory->define(User::class, function (Faker $faker) {
    return [
      'name' => $faker->name,
      'email' => $faker->unique()->safeEmail,
      'password' => bcrypt('123456'),
      'remember_token' => str_random(10),
    ];
  });
