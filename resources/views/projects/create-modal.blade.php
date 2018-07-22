<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title text-center" id="create_project_modal_label">Create new TODO List</h4>
    </div>
    {{ Form::open(['route' => 'projects.store', 'class' => 'store-project-form-js']) }}
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon">TODO List Name</div>
                {{ Form::text('store_project_name', '', ['class' => 'form-control', 'placeholder' => 'Input Todo List name ...']) }}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-store-project-js">Create</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    {{ Form::close() }}
  </div>
</div>
