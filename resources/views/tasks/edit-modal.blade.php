<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title text-center" id="edit_project_modal_label">Edit your task</h4>
    </div>
    {{ Form::open(['route' => ['tasks.update', $task->id], 'class' => 'update_task_form-js']) }}
    <div class="modal-body">
      <div class="container-fluid">
        <div class="row">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Task Name</div>
              {{ Form::text('update_task_name', $task->name, ['class' => 'form-control']) }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      {{ Form::submit('Update', ['class' => 'btn btn-success button-update-task-js']) }}
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    {{ Form::close() }}
  </div>
</div>
