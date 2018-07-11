<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 div-project-js">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-5"></div>
            <div class="col-lg-2 text-center">
              <span class="h1 panel-title">{{ $project->name }}</span>
            </div>
            <div class="col-lg-3"></div>
            <div class="col-lg-1">
              <!-- {{ Form::open(['route' => ['projects.edit', $project->id], 'method' => 'get']) }}
              {{ Form::submit('Edit', ['class' => 'btn btn-success btn-xs']) }}
              {{ Form::close() }} -->
              <button type="button" name="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#edit_project_modal">Edit</button>
            </div>
            <div class="col-lg-1">
              {{ Form::open(['route' => ['projects.destroy', $project->id], 'class' => 'delete_project_form']) }}
              {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs button-delete-project-js']) }}
              {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="panel-body">
      Panel content
    </div>
  </div>
</div>
