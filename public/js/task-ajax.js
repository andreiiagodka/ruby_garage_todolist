$(document).ready(function() {
  // store();
  show();
  edit();
  destroy();
  status();
  positionUp();
  positionDown();

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

function positionUp() {
  $(document).on('click', '.button-position-up-task-js', function() {
    let button_up = $(this);

    let form = $(this).closest('.position-up-task-form-js');
    let action = form.attr('action');

    let parent_li = form.parents('li');
    let task_position = parent_li.attr('position');
    let button_down = parent_li.find('.button-position-down-task-js');

    let prev_parent_li = parent_li.prev();
    let prev_task_id = prev_parent_li.attr('task_id');
    let prev_task_position = prev_parent_li.attr('position');
    let prev_task_button_up = prev_parent_li.find('.button-position-up-task-js');
    let prev_task_button_down = prev_parent_li.find('.button-position-down-task-js');
    $.ajax({
      url: action,
      type: 'POST',
      data: {
        prev_task_id: prev_task_id
      },
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        $(parent_li).attr('position', prev_task_position);
        $(prev_parent_li).attr('position', task_position);
        $(parent_li).insertBefore(prev_parent_li);
        if (prev_task_position == data.min_position) {
          button_up.hide();
          prev_task_button_up.show();
        } else if (task_position == data.max_position) {
          button_down.show();
          prev_task_button_down.hide();
        }
      }
    });
  })
}

function positionDown() {
  $(document).on('click', '.button-position-down-task-js', function() {
    let button_down = $(this);

    let form = $(this).closest('.position-down-task-form-js');
    let action = form.attr('action');

    let parent_li = form.parents('li');
    let button_up = parent_li.find('.button-position-up-task-js');
    let task_position = parent_li.attr('position');

    let next_parent_li = parent_li.next();
    let next_task_id = next_parent_li.attr('task_id');
    let next_task_position = next_parent_li.attr('position');
    let next_task_button_up = next_parent_li.find('.button-position-up-task-js');
    let next_task_button_down = next_parent_li.find('.button-position-down-task-js');
    $.ajax({
      url: action,
      type: 'POST',
      data: {
        next_task_id: next_task_id
      },
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        $(parent_li).attr('position', next_task_position);
        $(next_parent_li).attr('position', task_position);
        $(parent_li).insertAfter(next_parent_li);
        if (next_task_position == data.max_position) {
          button_down.hide();
          next_task_button_down.show();
        } else if (task_position == data.min_position) {
          next_task_button_up.hide();
          button_up.show();
        }
      }
    });
  });
}
