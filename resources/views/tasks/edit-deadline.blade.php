<div class="form-group deadline-form-container-js">
  <div class="input-group">
    {{ Form::open(['route' => ['tasks.deadline.update', $task->id], 'class' => 'update-task-deadline-form-js']) }}
      <input type="datetime-local" class="form-control deadline-update-input-js">
      <button type="button" class="btn btn-success btn-xs btn-update-task-deadline-js">Update</button>
    {{ Form::close() }}
  </div>
</div>
