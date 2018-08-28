<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Model;

  class Project extends Model
  {
    protected $fillable = ['name', 'user_id'];

    public function tasks() {
      return $this->hasMany(Task::class);
    }

    public static function validateUniqueName($project, $request) {
      if (strtolower($project->name) == strtolower($request->name)) return;
      $this->validate($request, ['name' => 'unique:projects,name,null,id,user_id,' . Auth::id()]);
    }
  }
