@extends('layouts.app')

@section('content')
  @include('projects.button')
  <div class="todolist-projects-js">
    @foreach ($projects as $project)
      @include('projects.project')
    @endforeach
  </div>
  @include('projects.modals')
@endsection
