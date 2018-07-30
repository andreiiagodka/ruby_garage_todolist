<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title text-center" id="edit_task_modal_label">Edit your task</h4>
    </div>
    {{ Form::open(['route' => ['tasks.update', $task->id], 'project_id' => $task->project_id, 'class' => 'update-task-form-js']) }}
    <div class="modal-body">
      <div class="container-fluid">
        <div class="row">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Task Name</div>
              {{ Form::text('update_task_name', $task->name, ['class' => 'form-control']) }}
            </div>
            <span class="errors-container-js"></span>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-success btn-update-task-js">Update</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    {{ Form::close() }}
  </div>
</div>
