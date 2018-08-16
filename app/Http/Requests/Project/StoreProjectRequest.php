<?php

  namespace App\Http\Requests\Project;

  use Illuminate\Foundation\Http\FormRequest;
  use Illuminate\Support\Facades\Auth;

  class StoreProjectRequest extends FormRequest
  {
    public function authorize()
    {
      return true;
    }

    public function rules()
    {
      return [
        'name' => 'required|string|unique:projects,name,null,id,user_id,' . Auth::id() . '|max:255'
      ];
    }

    public function messages() {
      return [
        'unique' => 'Such Todo List name is already in use.'
      ];
    }
  }
