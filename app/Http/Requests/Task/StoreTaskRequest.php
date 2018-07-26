<?php

  namespace App\Http\Requests\Task;

  use Illuminate\Foundation\Http\FormRequest;

  class StoreTaskRequest extends FormRequest
  {
    public function authorize()
    {
      return true;
    }

    public function rules()
    {
      return [
        'name' => 'required|string|unique:tasks,name,null,id,project_id,' . $this->project_id . '|max:255',
        'project_id' => 'required|integer'
      ];
    }
  }
