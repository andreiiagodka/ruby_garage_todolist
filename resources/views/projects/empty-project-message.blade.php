@if ($project->tasks->count() == 0)
  <em><span class="lead empty-project-msg-js">There are no tasks yet.</span></em>
@else
  <em><span class="lead empty-project-msg-js" style="display: none;">There are no tasks yet.</span></em>
@endif
