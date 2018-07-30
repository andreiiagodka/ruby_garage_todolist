<?php

  use Illuminate\Database\Seeder;
  use App\Models\User;

  class UsersSeeder extends Seeder
  {
    public function run()
    {
      factory(User::class, 3)->create();
    }
  }
