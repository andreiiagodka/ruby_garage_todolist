<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Support\Facades\Auth;
  use Carbon\Carbon;

  class Task extends Model
  {
    protected $fillable = ['name', 'position', 'deadline', 'project_id'];

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

    public function minPosition($task) {
      return $task->project->tasks->pluck('position')->min();
    }

    public function maxPosition($task) {
      return $task->project->tasks->pluck('position')->max();
    }
  }
