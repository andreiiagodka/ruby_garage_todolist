$(document).ready(function() {
  createTask();
  showTask();
  editTask();
  destroyTask();
});

function createTask() {
  $(document).on('click', '.btn-store-task-js', function() {
    let form = $(this).closest('form');
    validateStoreTask(form);
  });
}

function storeTask(form) {
  let panel_body = $(form).closest('.panel-body');
  let tasks_container = panel_body.next('.todolist-tasks-container-js');
  let action = $(form).attr('action');
  let store_task_input = $(form).find('input[name=store_task_name]');
  let task_name = store_task_input.val();
  let project_id = $(form).attr('project_id');
  let project_footer = panel_body.nextAll('.project-footer-js');
  $.ajax({
    url: action,
    type: 'POST',
    data: {
      name: task_name,
      project_id: project_id
    },
    headers: {
      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(data) {
      tasks_container.append(data.contents);
      store_task_input.val('');
      project_footer.empty();
      emptyErrorContainer(form);
      addBtnDownOnStore(tasks_container, data.task_position);
      alertSuccess(success_phrases.task_store);
    },
    error: function(data) {
      setError(form, data);
    }
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

function showTask() {
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

function editTask() {
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
        validateUpdateTask(task_name_container, modal);
        emptyHiddenModal(modal);
      }
    });
  });
}

function updateTask(form, task_name_container, modal) {
  let action = $(form).attr('action');
  let update_task_input = $(form).find('input[name=update_task_name]');
  let new_task_name = update_task_input.val();
  let project_id = $(form).attr('project_id');
  $.ajax({
    url: action,
    type: 'PUT',
    data: {
      name: new_task_name,
      project_id: project_id
    },
    headers: {
      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(data) {
      $(task_name_container).html(new_task_name);
      task_name_container.css('textTransform', 'capitalize');
      hideModal(modal);
      alertSuccess(success_phrases.task_update);
    },
    error: function(data) {
      setError(form, data);
    }
  });
}

function destroyTask() {
  $(document).on('click', '.btn-destroy-task-js', function() {
    let task_container = $(this).closest('.task-container-js');
    let form = $(this).closest('.destroy-task-form-js');
    let action = form.attr('action');
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

function handleDestroyResponse(container) {
  container.remove();
  alertSuccess(success_phrases.task_destroy);
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
