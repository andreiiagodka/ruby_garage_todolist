<?php

  namespace App\Http\Requests\Task;

  use Illuminate\Foundation\Http\FormRequest;

  class StatusTaskRequest extends FormRequest
  {
    public function authorize()
    {
      return true;
    }

    public function rules()
    {
      return [
        'status' => 'required|boolean'
      ];
    }
  }
