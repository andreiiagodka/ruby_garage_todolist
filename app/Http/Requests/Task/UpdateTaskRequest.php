<?php

  namespace App\Http\Requests\Task;

  use Illuminate\Foundation\Http\FormRequest;

  class UpdateTaskRequest extends FormRequest
  {
    public function authorize()
    {
      return true;
    }

    public function rules()
    {
      $task = $this->route('task');
      return [
        'name' => 'required|string|unique:tasks,name,' . $task . '|max:255'
      ];
    }
  }
