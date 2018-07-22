$(document).ready(function() {
  store();
  show();
  edit();
  destroy();
});

function store() {
  $(document).on('click', '.button-store-task-js', function(e) {
    e.preventDefault();
    let tasks_area = $(this).closest('.task-row-js').next('.todolist-tasks-js');
    let form = this.closest('.store_task_form-js');
    let action = $(form).attr('action');
    let input = $(form).find('input[name=store_task_name]');
    let name = input.val();
    let project_id = $(form).attr('project_id');
    $.ajax({
      url: action,
      type: 'POST',
      data: {
        name: name,
        project_id: project_id
      },
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      }
    }).done(function(data) {
      tasks_area.append(data.contents);
      input.val('');
      addButtonDownOnStore(tasks_area, data.task_position);
    });
  });
}

function addButtonDownOnStore(tasks_area, position) {
  let prev_task_position = position - 1;
  let prev_task = tasks_area.find('[position=' + prev_task_position + ']');
  if (prev_task) {
    let button_down = prev_task.find('.button-position-down-task-js');
    button_down.show();
  }
}

function show() {
  $(document).on('click', 'div.task-name-js', function() {
    let modal = $('#show_task_modal');
    modal.modal('show');
    let form = $(this).closest('.show-task-form-js');
    let action = $(form).attr('action');
    $.ajax({
      url: action,
      type: 'GET',
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        modal.append(data.contents);
        emptyHiddenModal(modal);
      }
    });
  });
}

function edit() {
  $(document).on('click', '.button-open-edit-task-modal-js', function(e) {
    e.preventDefault();
    let form = this.closest('.edit-task-form-js');
    let action = $(form).attr('action');
    let title = $(form).closest('.div-task-js').find('div.task-name-js');
    let modal = $('#edit_task_modal');
    $.ajax({
      url: action,
      type: 'GET',
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        $(modal).append(data.contents);
        update(title, modal);
        emptyHiddenModal(modal);
      }
    });
  });
}

function update(title, modal) {
  $('.button-update-task-js').click(function(e) {
    e.preventDefault();
    let name = $('input[name=update_task_name]').val();
    let action = $('.update_task_form-js').attr('action');
    let method = 'PUT';
    let data = {
      name: name
    };
    ajaxRequest(action, method, data, handleUpdateResponse(title, name, modal));
  });
}

function destroy() {
  $(document).on('click', '.button-destroy-task-js', function(e) {
    e.preventDefault();
    let form = this.closest('.destroy_task_form-js');
    let action = $(form).attr('action');
    let method = 'DELETE';
    let task_div = this.closest('.div-task-js');
    ajaxRequest(action, method, null, handleDestroyResponse(task_div));
  });
}
