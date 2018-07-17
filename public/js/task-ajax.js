$(document).ready(function() {
  // store();
  edit();
  destroy();
  status();

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
    });
  });
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

function status() {
  $(document).on('click', '.checkbox-set-status-task-js', function() {
    let form = $(this).closest('.status-task-form-js');
    let action = $(form).attr('action');
    let method = 'POST';
    let div_bg = $(this).closest('.bg-task-js');
    $(div_bg).hasClass('bg-success') ? value = 1 : value = 0;
    let data = {
      status: value
    }
    ajaxRequest(action, method, data, handleStatusResponse(div_bg));
  });
}

function handleStatusResponse(div_bg) {
  $(div_bg).toggleClass('bg-success');
}
