<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Support\Facades\Auth;
  use Carbon\Carbon;

  class Task extends Model
  {
    protected $fillable = ['position', 'deadline'];

    public function project() {
      return $this->belongsTo(Project::class);
    }

    public function getDeadlineAttribute($value) {
      return Carbon::parse($value)->format('d.m.Y H:i');
    }

    public function isAuthorizedUser($task) {
      $task_user_id = $task->project->user_id;
      $authorized_user_id = Auth::id();
      return $task_user_id == $authorized_user_id;
    }
  }
