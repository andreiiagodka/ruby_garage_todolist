<ul class="list-group todolist-tasks-container-js">
  @each('tasks.task', $project->tasks->sortBy('position'), 'task')
</ul>
