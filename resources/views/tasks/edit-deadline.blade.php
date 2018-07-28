<div class="form-group deadline-form-container-js">
  <div class="input-group">
    {{ Form::open(['route' => ['tasks.deadline.update', $task->id], 'class' => 'update-task-deadline-form-js']) }}
      <input type="datetime-local" name="update_deadline" class="form-control deadline-update-input-js">
      <button type="submit" class="btn btn-success btn-xs btn-update-task-deadline-js">Update</button>
      <button type="button" class="btn btn-default btn-xs btn-close-edit-task-deadline-js">Close</button>
      <span class="errors-container-js"></span>
    {{ Form::close() }}
  </div>
</div>
