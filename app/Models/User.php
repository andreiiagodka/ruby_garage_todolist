<?php

  namespace App\Models;

  use Illuminate\Notifications\Notifiable;
  use Illuminate\Foundation\Auth\User as Authenticatable;

  class User extends Authenticatable
  {
    protected $fillable = [
      'name', 'email', 'password',
    ];

    protected $hidden = [
      'password', 'remember_token',
    ];

    public function projects() {
      return $this->hasMany(Project::class);
    }
  }
