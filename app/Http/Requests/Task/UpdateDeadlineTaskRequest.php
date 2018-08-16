<?php

  namespace App\Http\Requests\Task;

  use Illuminate\Foundation\Http\FormRequest;
  use App\Models\Task;

  class UpdateDeadlineTaskRequest extends FormRequest
  {
    public function authorize()
    {
      return true;
    }

    public function rules()
    {
      $task = Task::find($this->route('task'));
      return [
        'deadline' => 'required|date|after_or_equal:' . $task->deadline
      ];
    }

    public function messages() {
      return [
        'after_or_equal' => 'The deadline must be a date after or equal to current.'
      ];
    }
  }
