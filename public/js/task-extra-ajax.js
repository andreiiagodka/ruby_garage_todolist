$(document).ready(function() {
  status();
  deadlineEdit();
  positionUp();
  positionDown();
});

function status() {
  $(document).on('click', '.cbx-status-task-js', function() {
    let form = $(this).closest('.status-task-form-js');
    let action = $(form).attr('action');
    let method = 'POST';
    let task_bg = $(this).closest('.bg-task-js');
    $(task_bg).hasClass('bg-success') ? value = 1 : value = 0;
    let data = {
      status: value
    }
    ajaxRequest(action, method, data, handleStatusResponse(task_bg));
  });
}

function handleStatusResponse(task_bg) {
  $(task_bg).toggleClass('bg-success');
  alertSuccess(success_phrases.task_status);
}

function positionUp() {
  $(document).on('click', '.btn-position-up-task-js', function() {
    let btn_up = $(this);

    let form = $(this).closest('.position-up-task-form-js');
    let action = form.attr('action');

    let task_container = form.parents('.task-container-js');
    let task_position = task_container.attr('position');
    let btn_down = task_container.find('.btn-position-down-task-js');

    let prev_task_container = task_container.prev();
    let prev_task_id = prev_task_container.attr('task_id');
    let prev_task_position = prev_task_container.attr('position');
    let prev_task_btn_up = prev_task_container.find('.btn-position-up-task-js');
    let prev_task_btn_down = prev_task_container.find('.btn-position-down-task-js');
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
        $(task_container).attr('position', prev_task_position);
        $(prev_task_container).attr('position', task_position);
        $(task_container).insertBefore(prev_task_container);

        if (prev_task_position == data.min_position) {
          btnHideShow(btn_up, prev_task_btn_up);
        } else if (task_position == data.max_position) {
          btnHideShow(prev_task_btn_down, btn_down);
        }
      }
    });
  })
}

function positionDown() {
  $(document).on('click', '.btn-position-down-task-js', function() {
    let btn_down = $(this);

    let form = $(this).closest('.position-down-task-form-js');
    let action = form.attr('action');

    let task_container = form.parents('li');
    let btn_up = task_container.find('.btn-position-up-task-js');
    let task_position = task_container.attr('position');

    let next_task_container = task_container.next();
    let next_task_id = next_task_container.attr('task_id');
    let next_task_position = next_task_container.attr('position');
    let next_task_btn_up = next_task_container.find('.btn-position-up-task-js');
    let next_task_btn_down = next_task_container.find('.btn-position-down-task-js');
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
        $(task_container).attr('position', next_task_position);
        $(next_task_container).attr('position', task_position);
        $(task_container).insertAfter(next_task_container);

        if (next_task_position == data.max_position) {
          btnHideShow(btn_down, next_task_btn_down);
        } else if (task_position == data.min_position) {
          btnHideShow(next_task_btn_up, btn_up);
        }
      }
    });
  });
}

function deadlineEdit() {
  $(document).on('click', '.btn-edit-task-deadline-js', function() {
    let btn_edit = $(this);
    let form = $(this).closest('.edit-task-deadline-form-js');
    let action = form.attr('action');
    let deadline_info = form.closest('.deadline-info-js');
    $.ajax({
      url: action,
      type: 'GET',
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        deadline_info.append(data.contents);
        btn_edit.hide();
        deadlineUpdate(deadline_info, btn_edit);
      }
    });
  });
}

function deadlineUpdate(deadline_info, btn_edit) {
  $(document).on('click', '.btn-update-task-deadline-js', function() {
    let form = $(this).closest('.update-task-deadline-form-js');
    let action = form.attr('action');
    let deadline = form.find('.deadline-update-input-js').val();
    let method = 'POST';
    let data = {
      deadline: deadline
    };
    ajaxRequest(action, method, data, handleDeadlineUpdateResponse(deadline, deadline_info, btn_edit));
  });
}

function handleDeadlineUpdateResponse(deadline, deadline_info, btn_edit) {
  let date = new Date(deadline);
  let new_deadline = date.toLocaleDateString() + ' ' + (date.toLocaleTimeString()).slice(0, -3);
  let deadline_span = deadline_info.find('span.deadline-js');
  deadline_span.html(new_deadline);
  deadline_info.find('.deadline-form-container-js').remove();
  btn_edit.show();
}
