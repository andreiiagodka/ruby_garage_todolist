$(document).ready(function() {
  create();

  $(document).on('click', '.project-name-container-js', function() {
    let modal = $('#show_project_modal')
    let form = $(this).closest('.show-project-form-js');
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

  $(document).on('click', '.btn-open-edit-project-modal-js', function() {
    let modal = $('#edit_project_modal');

    let form = $(this).closest('.edit-project-form-js');
    let project_name = form.closest('.project-container-js').find('.panel-title');
    let action = form.attr('action');
    $.ajax({
      url: action,
      type: 'GET',
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (data) {
        modal.append(data.contents);
        validateUpdateProject(project_name, modal);
        emptyHiddenModal(modal);
      }
    });
  });

  $(document).on('click', '.btn-destroy-project-js', function() {
    let form = $(this).closest('.destroy-project-form-js');
    let action = form.attr('action');
    let method = 'DELETE';
    let project_container = this.closest('.project-container-js');
    ajaxRequest(action, method, null, handleProjectDestroyResponse(project_container));
  });
});

function handleProjectDestroyResponse(container) {
  container.remove();
  alertSuccess(success_phrases.project_destroy);
}

function create() {
  $('.btn-open-create-project-modal-js').click(function() {
    let action = $('.create-project-form-js').attr('action');
    let modal = $('#create_project_modal');
    let error_container = $(this).closest('.errors-container-js');
    $.ajax({
      url: action,
      type: 'GET',
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (data) {
        modal.append(data.contents);
        validateStoreProject(modal);
        emptyHiddenModal(modal);
      }
    });
  });
}

function storeProject(modal) {
  let projects_container = $('.todolist-projects-container-js');
  let project_name = $('input[name=store_project_name]').val();
  let form = $('.store-project-form-js');
  let action = form.attr('action');
  let error_container = form.find('.errors-container-js');
  $.ajax({
    url: action,
    type: 'POST',
    data: {
      name: project_name
    },
    headers: {
      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(data) {
      projects_container.append(data.contents);
      hideModal(modal);
      alertSuccess(success_phrases.project_store);
    },
    error: function(data) {
      setError(error_container, data);
    }
  });
}

function updateProject(project_name, modal) {
  let new_project_name = $('input[name=update_project_name]').val();
  let form = $('.update-project-form-js');
  let action = form.attr('action');
  let error_container = form.find('.errors-container-js');
  $.ajax({
    url: action,
    type: 'PUT',
    data: {
      name: new_project_name
    },
    headers: {
      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(data) {
      $(project_name).html(new_project_name);
      hideModal(modal);
      alertSuccess(success_phrases.project_update);
    },
    error: function(data) {
      setError(error_container, data);
    }
  });
}
