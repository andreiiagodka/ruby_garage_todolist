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

    public function getNameAttribute($value) {
      return ucfirst($value);
    }

    public function getDeadlineAttribute($value) {
      return Carbon::parse($value)->format('d.m.Y H:i');
    }

    public function minPosition() {
      return $this->project->tasks->pluck('position')->min();
    }

    public function maxPosition() {
      return $this->project->tasks->pluck('position')->max();
    }
  }
