function validateStoreProject(modal) {
  $('.store-project-form-js').validate({
    rules: {
      store_project_name: {
        required: true,
        maxlength: 255
      }
    },
    messages: {
      store_project_name: {
        required: 'Todo List name is required.',
        maxlength: 'Todo List name has to be shorter.'
      }
    },
    errorPlacement: function(error, element) {
      placeError(error, element);
    },
    submitHandler: function() {
      storeProject(modal);
    }
  });
}

function validateUpdateProject(project_name, modal) {
  $('.update-project-form-js').validate({
    rules: {
      update_project_name: {
        required: true,
        maxlength: 255
      }
    },
    messages: {
      update_project_name: {
        required: 'Todo List name is required.',
        maxlength: 'Todo List name has to be shorter.'
      }
    },
    errorPlacement: function(error, element) {
      placeError(error, element);
    },
    submitHandler: function() {
      updateProject(project_name, modal);
    }
  });
}

function validateStoreTask(form) {
  form.validate({
    rules: {
      store_task_name: {
        required: true,
        maxlength: 255
      }
    },
    messages: {
      store_task_name: {
        required: 'Task name is required.',
        maxlength: 'Task name has to be shorter.'
      }
    },
    errorPlacement: function(error, element) {
      placeError(error, element);
    },
    submitHandler: function(element) {
      storeTask(element);
    }
  });
}

function validateDeadlineUpdate(deadline_info, btn_edit) {
  $('.update-task-deadline-form-js').validate({
    rules: {
      update_deadline: {
        required: true
      }
    },
    messages: {
      update_deadline: {
        required: 'Task deadline is required.'
      }
    },
    errorPlacement: function(error, element) {
      placeError(error, element);
    },
    submitHandler: function(element) {
      deadlineUpdate(element, deadline_info, btn_edit);
    }
  });
}

function placeError(error, element) {
  let error_container = element.parents('form').find('.errors-container-js');
  error_container.empty();
  error.appendTo(error_container);
}
