<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Model;
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

  }
