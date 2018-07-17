@include('tasks.create')
<ul class="list-group todolist-tasks-js">
  @foreach ($project->tasks as $task)
    @include('tasks.task')
  @endforeach
</ul>
