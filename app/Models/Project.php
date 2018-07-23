<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Support\Facades\Auth;

  class Project extends Model
  {
    protected $fillable = ['name', 'user_id'];

    public function tasks() {
      return $this->hasMany(Task::class);
    }

    public function isAuthorizedUser($project) {
      $project_user_id = $project->user_id;
      $authorized_user_id = Auth::id();
      return $project_user_id == $authorized_user_id;
    }
  }
