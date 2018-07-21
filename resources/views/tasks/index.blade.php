@include('tasks.create')
<ul class="list-group todolist-tasks-js">
  @each('tasks.task', $project->tasks->sortBy('position'), 'task')
</ul>
