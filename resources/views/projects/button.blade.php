{{ Form::open(['route' => 'projects.create', 'class' => 'create-project-form-js', 'method' => 'GET']) }}
  {{ Form::submit('Add TODO List', ['class' => 'btn btn-primary center-block button-open-create-project-modal-js', 'data-toggle' => 'modal', 'data-target' => '#create_project_modal']) }}
{{ Form::close() }}
