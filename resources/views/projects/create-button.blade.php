{{ Form::open(['route' => 'projects.create', 'class' => 'create-project-form-js']) }}
  <button type="button" class="btn btn-primary center-block btn-open-create-project-modal-js" data-toggle="modal" data-target="#create_project_modal">
    <i class="fa fa-plus" aria-hidden="true"></i>
    Add TODO List
  </button>
{{ Form::close() }}
