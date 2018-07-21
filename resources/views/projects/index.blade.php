@extends('layouts.app')

@section('content')
  @include('projects.button')
  <div class="todolist-projects-js">
    @foreach ($projects as $project)
      @include('projects.project', ['min_position' => 'min_position'])
    @endforeach
  </div>
  @include('projects.modals')
  @include('tasks.modals')
@endsection
