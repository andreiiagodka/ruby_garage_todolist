function validateStoreProject(modal) {
  $('.store-project-form-js').validate({
    errorElement: 'span',
    errorClass: 'form-errors',
    rules: {
      store_project_name: {
        required: true,
        maxlength: 255
      }
    },
    messages: {
      store_project_name: {
        required: validation_phrases.project_required,
        maxlength: validation_phrases.project_maxlength
      }
    },
    errorPlacement: function(error, element) {
      placeError(error, element);
    },
    submitHandler: function(element) {
      storeProject(element, modal);
    }
  });
}

function validateUpdateProject(project_name, modal) {
  $('.update-project-form-js').validate({
    errorElement: 'span',
    errorClass: 'form-errors',
    rules: {
      update_project_name: {
        required: true,
        maxlength: 255
      }
    },
    messages: {
      update_project_name: {
        required: validation_phrases.project_required,
        maxlength: validation_phrases.project_maxlength
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
    errorElement: 'span',
    errorClass: 'form-errors',
    rules: {
      store_task_name: {
        required: true,
        maxlength: 255
      }
    },
    messages: {
      store_task_name: {
        required: validation_phrases.task_required,
        maxlength: validation_phrases.task_maxlength
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

function validateUpdateTask(task_name_container, modal) {
  $('.update-task-form-js').validate({
    errorElement: 'span',
    errorClass: 'form-errors',
    rules: {
      update_task_name: {
        required: true,
        maxlength: 255
      }
    },
    messages: {
      update_task_name: {
        required: validation_phrases.task_required,
        maxlength: validation_phrases.task_maxlength
      }
    },
    errorPlacement: function(error, element) {
      placeError(error, element);
    },
    submitHandler: function(element) {
      updateTask(element, task_name_container, modal);
    }
  });
}

function validateDeadlineUpdate(deadline_info, btn_edit) {
  $('.update-task-deadline-form-js').validate({
    errorElement: 'span',
    errorClass: 'form-errors',
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
      updateDeadlineTask(element, deadline_info, btn_edit);
    }
  });
}

function placeError(error, element) {
  let error_container = element.parents('form').find('.errors-container-js');
  error_container.removeClass('form-errors');
  error_container.empty();
  error.appendTo(error_container);
}

let validation_phrases = {
  project_required: 'Todo List name is required.',
  project_maxlength: 'Todo List name has to be shorter (max is 255 symbols).',
  task_required: 'Task name is required.',
  task_maxlength: 'Task name has to be shorter (max is 255 symbols).'
}
