<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 project-container-js">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-5"></div>
            {{ Form::open(['route' => ['projects.show', $project->id], 'class' => 'show-project-form-js']) }}
            <div class="col-lg-2 text-center project-name-container-js" data-toggle="modal" data-target="#show_project_modal">
              <span class="h1 panel-title">{{ $project->name }}</span>
            </div>
            {{ Form::close() }}
            <div class="col-lg-3"></div>
            <div class="col-lg-1">
              {{ Form::open(['route' => ['projects.edit', $project->id], 'class' => 'edit-project-form-js']) }}
                <button type="button" class="btn btn-default btn-xs btn-open-edit-project-modal-js" data-toggle="modal" data-target="#edit_project_modal">Edit</button>
              {{ Form::close() }}
            </div>
            <div class="col-lg-1">
              {{ Form::open(['route' => ['projects.destroy', $project->id], 'class' => 'destroy-project-form-js']) }}
                <button type="button" class="btn btn-danger btn-xs btn-destroy-project-js">Delete</button>
              {{ Form::close() }}
            </div>
          </div>
        </div>
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
