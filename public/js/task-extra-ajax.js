$(document).ready(function() {
  status();
  deadlineEdit();
  positionUp();
  positionDown();
});

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

function deadlineEdit() {
  $(document).on('click', '.btn-edit-task-deadline-task-js', function() {
    let form = $(this).closest('.edit-task-deadline-form-js');
    let action = form.attr('action');

    let btn_edit = $(this);
    let deadline_area = form.closest('.deadline-container-js');
    $.ajax({
      url: action,
      type: 'GET',
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        deadline_area.append(data.contents);
        btn_edit.hide();
        deadlineUpdate(deadline_area, btn_edit);
      }
    });
  });
}

function deadlineUpdate(deadline_area, btn_edit) {
  $(document).on('click', '.btn-update-task-deadline-task-js', function() {
    let form = $(this).closest('.update-task-deadline-form-js');
    let action = form.attr('action');
    let deadline = form.find('.deadline-input-js').val();
    $.ajax({
      url: action,
      type: 'POST',
      data: {
        deadline: deadline
      },
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        let date = new Date(deadline);
        let new_deadline = date.toLocaleDateString() + ' ' + (date.toLocaleTimeString()).slice(0, -3);
        let deadline_span = deadline_area.find('.span-deadline-js');
        deadline_span.html(new_deadline);
        deadline_area.find('.div-deadline-js').remove();
        btn_edit.show();
      }
    });
  });
}
