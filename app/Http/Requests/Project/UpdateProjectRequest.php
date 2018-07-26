<?php

  namespace App\Http\Requests\Project;

  use Illuminate\Foundation\Http\FormRequest;

  class UpdateProjectRequest extends FormRequest
  {
    public function authorize()
    {
      return true;
    }

    public function rules()
    {
      $project = $this->route('project');
      return [
        'name' => 'required|string|unique:projects,name,' . $project . '|max:255'
      ];
    }
  }
