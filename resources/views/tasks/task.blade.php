<li class="list-group-item div-task-js">
  <div class="container-fluid">
    <div class="row">
      @if ($task->status == 1)
        <div class="col-lg-12 bg-success bg-task-js">
      @else
        <div class="col-lg-12 bg-task-js">
      @endif
        <div class="col-lg-9 task-name-js">
          {{ $task->name }}
        </div>
        <div class="col-lg-1">
          {{ Form::open(['route' => ['tasks.status', $task->id], 'class' => 'status-task-form-js']) }}
            {{ Form::checkbox('task_status', '', $task->status, ['class' => 'checkbox-set-status-task-js']) }}
          {{ Form::close() }}
        </div>
        <div class="col-lg-1">
          {{ Form::open(['route' => ['tasks.edit', $task->id], 'class' => 'edit-task-form-js']) }}
            <button type="button" class="btn btn-default btn-xs button-open-edit-task-modal-js" data-toggle="modal" data-target="#edit_task_modal">Edit</button>
          {{ Form::close() }}
        </div>
        <div class="col-lg-1">
          {{ Form::open(['route' => ['tasks.destroy', $task->id], 'class' => 'destroy_task_form-js']) }}
            <button type="button" class="btn btn-danger btn-xs button-destroy-task-js">Delete</button>
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
</li>
