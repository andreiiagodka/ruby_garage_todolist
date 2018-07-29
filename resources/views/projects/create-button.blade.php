<div class="row">
  {{ Form::open(['route' => 'projects.create', 'class' => 'create-project-form-js']) }}
  <button type="button" class="btn center-block btn-add-project btn-open-create-project-modal-js" data-toggle="modal" data-target="#create_project_modal">
    <i class="fa fa-plus fa-plus-project mr-10" aria-hidden="true"></i>
    <span class="btn-description">Add TODO List</span>
  </button>
  {{ Form::close() }}
</div>
