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
      $task_id = $this->route('task');
      $task = Task::find($task_id);
      return [
        'deadline' => 'required|date|after_or_equal:' . $task->deadline
      ];
    }
  }
