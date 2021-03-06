<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title text-center" id="show_task_modal_label">Task Information</h4>
    </div>
    <div class="modal-body">
      <div class="container-fluid">
        <div class="row">
          <div class="form-group">
            <div class="input-group">
              <div class="table-responsive ">
                <table class="table table-striped table-hover table-task">
                  <tr>
                    <th>Name</th>
                    <td>{{ $task->name }}</td>
                  </tr>
                  <tr>
                    <th>Status</th>
                    @if ($task->status == 1)
                    <td>Completed</td>
                    @else
                    <td>In process</td>
                    @endif
                  </tr>
                  <tr>
                    <th>Created</th>
                    <td>{{ $task->created_at->diffForHumans() }}</td>
                  </tr>
                  <tr>
                    <th>Updated</th>
                    <td>{{ $task->updated_at->diffForHumans() }}</td>
                  </tr>
                  <tr>
                    <th>Deadline</th>
                    <td class="deadline-info-js">
                      {{ Form::open(['route' => ['tasks.deadline.edit', $task->id], 'class' => 'form-inline edit-task-deadline-form-js']) }}
                      <div class="form-group">
                        <div class="input-group">
                          <span class="deadline-js">{{ $task->deadline }}</span>
                          <button type="button" class="btn btn-default ml-15 btn-edit-task-deadline-js">Edit</button>
                        </div>
                      </div>
                      {{ Form::close() }}
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
