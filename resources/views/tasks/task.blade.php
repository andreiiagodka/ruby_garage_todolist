<li class="list-group-item task-container-js" task_id="{{ $task->id }}" position="{{ $task->position }}">
  <div class="container-fluid">
    <div class="row">
      @if ($task->status == 1)
        <div class="col-lg-12 bg-success bg-task-js">
      @else
        <div class="col-lg-12 bg-task-js">
      @endif
        {{ Form::open(['route' => ['tasks.show', $task->id], 'class' => 'show-task-form-js']) }}
        <div class="col-lg-7 task-name-js">
          {{ $task->name }}
        </div>
        {{ Form::close() }}
        <div class="col-lg-1">
          {{ Form::open(['route' => ['tasks.position-up', $task->id], 'class' => 'position-up-task-form-js']) }}
            @php
              $min_position = $task->project->tasks->pluck('position')->min();
            @endphp
            @if ($task->position == $min_position)
              <button type="button" class="btn btn-default btn-xs btn-position-up-task-js" style="display: none;">Up</button>
            @else
              <button type="button" class="btn btn-default btn-xs btn-position-up-task-js">Up</button>
            @endif
          {{ Form::close() }}
        </div>
        <div class="col-lg-1">
          {{ Form::open(['route' => ['tasks.position-down', $task->id], 'class' => 'position-down-task-form-js']) }}
            @php
              $max_position = $task->project->tasks->pluck('position')->max();
            @endphp
            @if ($task->position == $max_position)
              <button type="button" class="btn btn-default btn-xs btn-position-down-task-js" style="display: none;">Down</button>
            @else
              <button type="button" class="btn btn-default btn-xs btn-position-down-task-js">Down</button>
            @endif
          {{ Form::close() }}
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
