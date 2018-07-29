@extends('layouts.app')

@section('content')
  @include('partials.header')
  @include('alerts.alert')
  <div class="row mb-25">
    <div class="todolist-projects-container-js">
      @foreach ($projects as $project)
      @include('projects.project', ['min_position' => 'min_position'])
      @endforeach
    </div>
  </div>
  @include('projects.create-button')
  @include('projects.modals')
  @include('tasks.modals')
@endsection
