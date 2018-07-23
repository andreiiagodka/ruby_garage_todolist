@extends('layouts.app')

@section('content')
  @include('alerts.alert')
  @include('projects.create-button')
  <div class="todolist-projects-container-js">
    @foreach ($projects as $project)
      @include('projects.project', ['min_position' => 'min_position'])
    @endforeach
  </div>
  @include('projects.modals')
  @include('tasks.modals')
@endsection
