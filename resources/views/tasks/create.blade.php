<div class="row task-row-js">
  <div class="form-group">
    {{ Form::open(['route' => 'tasks.store', 'project_id' => $project->id, 'class' => 'store_task_form-js']) }}
    <div class="input-group">
      {{ Form::text('store_task_name', '', ['class' => 'form-control','placeholder' => 'Start typing here to create a task ...']) }}
      <span class="input-group-btn">
        {{ Form::submit('Add task', ['class' => 'btn btn-success button-store-task-js']) }}
      </span>
    </div>
    {{ Form::close() }}
  </div>
</div>
