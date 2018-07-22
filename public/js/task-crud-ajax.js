$(document).ready(function() {
  store();
  show();
  edit();
  destroy();
});

function store() {
  $(document).on('click', '.btn-store-task-js', function() {
    let tasks_container = $(this).closest('.store-task-form-container-js').next('.todolist-tasks-container-js');

    let form = $(this).closest('.store-task-form-js');
    let action = form.attr('action');
    let store_task_input = form.find('input[name=store_task_name]');
    let task_name = store_task_input.val();
    let project_id = form.attr('project_id');
    $.ajax({
      url: action,
      type: 'POST',
      data: {
        name: task_name,
        project_id: project_id
      },
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      }
    }).done(function(data) {
      tasks_container.append(data.contents);
      store_task_input.val('');
      addBtnDownOnStore(tasks_container, data.task_position);
    });
  });
}

function addBtnDownOnStore(tasks_container, position) {
  let prev_task_position = position - 1;
  let prev_task = $(tasks_container).find('[position=' + prev_task_position + ']');
  if (prev_task) {
    let btn_down = prev_task.find('.btn-position-down-task-js');
    btn_down.show();
  }
}

function show() {
  $(document).on('click', '.task-name-container-js', function() {
    let modal = $('#show_task_modal');
    let form = $(this).closest('.show-task-form-js');
    let action = form.attr('action');
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
  $(document).on('click', '.btn-open-edit-task-modal-js', function() {
    let modal = $('#edit_task_modal');

    let form = $(this).closest('.edit-task-form-js');
    let action = form.attr('action');
    let task_name_container = form.parents('.task-container-js').find('.task-name-js');
    $.ajax({
      url: action,
      type: 'GET',
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        modal.append(data.contents);
        update(task_name_container, modal);
        emptyHiddenModal(modal);
      }
    });
  });
}

function update(task_name_container, modal) {
  $('.btn-update-task-js').click(function() {
    let new_task_name = $('input[name=update_task_name]').val();
    let action = $('.update-task-form-js').attr('action');
    let method = 'PUT';
    let data = {
      name: new_task_name
    };
    ajaxRequest(action, method, data, handleUpdateResponse(task_name_container, new_task_name, modal));
  });
}

function destroy() {
  $(document).on('click', '.btn-destroy-task-js', function() {
    let form = $(this).closest('.destroy-task-form-js');
    let action = form.attr('action');
    let task_container = this.closest('.task-container-js');
    $.ajax({
      url: action,
      type: 'DELETE',
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        addBtnUpDownOnDestroy(task_container, data);
        handleDestroyResponse(task_container);
      }
    });
  });
}

function addBtnUpDownOnDestroy(task_container, data) {
  let tasks_container = task_container.closest('.todolist-tasks-container-js');
  if (data.task_position == data.min_position) {
    let next_task_position = data.task_position + 1;
    let next_task = $(tasks_container).find('[position=' + next_task_position + ']');
    let btn_up = next_task.find('.btn-position-up-task-js');
    btn_up.hide();
  } else if (data.task_position == data.max_position) {
    let prev_task_position = data.task_position - 1;
    let prev_task = $(tasks_container).find('[position=' + prev_task_position + ']');
    let btn_down = prev_task.find('.btn-position-down-task-js');
    btn_down.hide();
  }
}
