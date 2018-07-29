<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 project-container-js">
  <div class="panel panel-primary">
    <div class="panel-heading panel-heading-custom">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <i class="fa fa-calendar fa-calendar-project" aria-hidden="true"></i>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 project-name-container-js" data-toggle="modal" data-target="#show_project_modal">
            {{ Form::open(['route' => ['projects.show', $project->id], 'class' => 'show-project-form-js']) }}
            <span class="panel-title project-name">{{ $project->name }}</span>
            {{ Form::close() }}
          </div>
          <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-right">
            {{ Form::open(['route' => ['projects.edit', $project->id], 'class' => 'edit-project-form-js']) }}
            <i class="fa fa-pencil fa-crud-project btn-open-edit-project-modal-js" aria-hidden="true" data-toggle="modal" data-target="#edit_project_modal"></i>
            {{ Form::close() }}
          </div>
          <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 bl-1">
            {{ Form::open(['route' => ['projects.destroy', $project->id], 'class' => 'destroy-project-form-js']) }}
            <i class="fa fa-trash fa-crud-project btn-destroy-project-js" aria-hidden="true"></i>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    <div class="panel-body panel-task-create">
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
        <i class="fa fa-plus fa-task-create" aria-hidden="true"></i>
      </div>
      <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
        @include('tasks.create')
      </div>
    </div>
    <div class="panel-body">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @include('tasks.index')
          </div>
        </div>
      </div>
    </div>

    </div>
  </div>
</div>
