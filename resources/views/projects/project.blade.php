<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 project-container-js">
  <div class="panel panel-primary">
    <div class="panel-heading panel-heading-custom">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-10">
          <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
            <i class="fa fa-calendar fa-calendar-project" aria-hidden="true"></i>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-6 col-xs-6 pd-l-0 project-name-container-js" data-toggle="modal" data-target="#show_project_modal">
            {{ Form::open(['route' => ['projects.show', $project->id], 'class' => 'show-project-form-js']) }}
            <span class="panel-title project-name">{{ $project->name }}</span>
            {{ Form::close() }}
          </div>
          <section class="fa-crud-hidden">
            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2 text-right">
              {{ Form::open(['route' => ['projects.edit', $project->id], 'class' => 'edit-project-form-js']) }}
              <i class="fa fa-pencil fa-crud-project btn-open-edit-project-modal-js" aria-hidden="true" data-toggle="modal" data-target="#edit_project_modal"></i>
              {{ Form::close() }}
            </div>
            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2 bl-1-lightgray">
              {{ Form::open(['route' => ['projects.destroy', $project->id], 'class' => 'destroy-project-form-js']) }}
              <i class="fa fa-trash fa-crud-project btn-destroy-project-js" aria-hidden="true"></i>
              {{ Form::close() }}
            </div>
          </section>
        </div>
      </div>
    </div>
    <div class="panel-body task-create-section panel-task-create">
      <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
        <i class="fa fa-plus fa-plus-task" aria-hidden="true"></i>
      </div>
      <div class="col-lg-11 col-md-11 col-sm-10 col-xs-10">
        @include('tasks.create')
      </div>
    </div>
    @include('tasks.index')
    <div class="panel-body"></div>
    </div>
  </div>
</div>
