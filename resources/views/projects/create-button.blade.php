<div class="row">
  {{ Form::open(['route' => 'projects.create', 'class' => 'create-project-form-js']) }}
  <button type="button" class="center-block btn-add-todo btn-open-create-project-modal-js" data-toggle="modal" data-target="#create_project_modal">
    <i class="fa fa-plus fa-descr mr-10" aria-hidden="true"></i>
    <span class="btn-descr">Add TODO List</span>
  </button>
  {{ Form::close() }}
</div>
