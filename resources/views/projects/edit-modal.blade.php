<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title text-center" id="edit_project_modal_label">Edit your TODO List</h4>
    </div>
    {{ Form::open(['route' => ['projects.update', $project->id], 'class' => 'update-project-form-js']) }}
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon">TODO List Name</div>
                {{ Form::text('update_project_name', $project->name, ['class' => 'form-control']) }}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-update-project-js">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    {{ Form::close() }}
  </div>
</div>
