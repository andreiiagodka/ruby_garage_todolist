<li class="list-group-item task-container task-container-js" task_id="{{ $task->id }}" position="{{ $task->position }}">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2 mt-15">
          {{ Form::open(['route' => ['tasks.status', $task->id], 'class' => 'status-task-form-js']) }}
          {{ Form::checkbox('task_status', '', $task->status, ['class' => 'task-cbx cbx-status-task-js']) }}
          {{ Form::close() }}
        </div>
        {{ Form::open(['route' => ['tasks.show', $task->id], 'class' => 'show-task-form-js']) }}
        <div class="col-lg-8 col-md-8 col-sm-4 col-xs-4 mt-15 task-name-container-js" data-toggle="modal" data-target="#show_task_modal">
          @if ($task->status == 1)
          <span class="task-name text-success task-name-js">{{ $task->name }}</span>
          @else
          <span class="task-name task-name-js">{{ $task->name }}</span>
          @endif
        </div>
        {{ Form::close() }}
        <section class="fa-crud-hidden">
          <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2 text-right">
            {{ Form::open(['route' => ['tasks.position-up', $task->id], 'class' => 'position-up-task-form-js']) }}
            @php
            $min_position = $task->project->tasks->pluck('position')->min();
            @endphp
            @if ($task->position == $min_position)
            <i class="fa fa-sort-up fa-caret-up-down btn-position-up-task-js" aria-hidden="true" style="display: none;"></i>
            @else
            <i class="fa fa-sort-up fa-caret-up-down btn-position-up-task-js" aria-hidden="true"></i>
            @endif
            {{ Form::close() }}

            {{ Form::open(['route' => ['tasks.position-down', $task->id], 'class' => 'position-down-task-form-js']) }}
            @php
            $max_position = $task->project->tasks->pluck('position')->max();
            @endphp
            @if ($task->position == $max_position)
            <i class="fa fa-sort-down fa-caret-up-down btn-position-down-task-js" style="display: none;"></i>
            @else
            <i class="fa fa-sort-down fa-caret-up-down btn-position-down-task-js" aria-hidden="true"></i>
            @endif
            {{ Form::close() }}
          </div>
          <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2 mt-15 bl-1-gray text-right">
            {{ Form::open(['route' => ['tasks.edit', $task->id], 'class' => 'edit-task-form-js']) }}
            <i class="fa fa-pencil fa-crud-task btn-open-edit-task-modal-js" aria-hidden="true" data-toggle="modal" data-target="#edit_task_modal"></i>
            {{ Form::close() }}
          </div>
          <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2 bl-1-gray mt-15">
            {{ Form::open(['route' => ['tasks.destroy', $task->id], 'class' => 'destroy-task-form-js']) }}
            <i class="fa fa-trash fa-crud-task btn-xs btn-destroy-task-js" aria-hidden="true"></i>
            {{ Form::close() }}
          </div>
        </section>
      </div>
    </div>
  </div>
</li>
