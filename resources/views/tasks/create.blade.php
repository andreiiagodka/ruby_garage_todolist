<div class="row store-task-form-container-js">
  <div class="form-group">
    {{ Form::open(['route' => 'tasks.store', 'project_id' => $project->id, 'class' => 'store-task-form-js']) }}
    <div class="input-group">
      {{ Form::text('store_task_name', '', ['class' => 'form-control','placeholder' => 'Start typing here to create a task ...']) }}
      <span class="input-group-btn">
        <button type="button" class="btn btn-success btn-store-task-js">Add task</button>
      </span>
    </div>
    {{ Form::close() }}
  </div>
</div>
