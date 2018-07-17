$(document).ready(function() {
  create();
  // edit();
  // destroy();

  $(document).on('click', '.button-open-edit-project-modal-js', function(e) {
    e.preventDefault();
    let form = $(this).closest('.edit-project-form-js');
    let title = $(form).closest('.div-project-js').find('span.panel-title');
    let action = $(form).attr('action');
    let modal = $('#edit_project_modal');
    $.ajax({
      url: action,
      type: 'GET',
      data: {
        name: name
      },
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (data) {
        modal.append(data.contents);
        // update(title, modal);

        $('.button-update-project-js').click({title, modal}, function(e) {
          e.preventDefault();
          let name = $('input[name=update_project_name]').val();
          let action = $('.update_project_form-js').attr('action');
          let method = 'PUT';
          let data = {
            name: name
          };
          ajaxRequest(action, method, data, handleUpdateResponse(title, name, modal));
        });
        emptyHiddenModal(modal);
      }
    });
  });

  $(document).on('click', '.button-destroy-project-js', function(e) {
    e.preventDefault();
    let form = this.closest('.destroy_project_form-js');
    let action = $(form).attr('action');
    let method = 'DELETE';
    let project_div = this.closest('.div-project-js');
    ajaxRequest(action, method, null, handleDestroyResponse(project_div));
  });
});

function create() {
  $('.button-open-create-project-modal-js').click(function(e) {
    e.preventDefault();
    let action = $('.create-project-form-js').attr('action');
    let modal = $('#create_project_modal');
    $.ajax({
      url: action,
      type: 'GET',
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (data) {
        modal.append(data.contents);
        $('.button-store-project-js').click(function(e) {
          e.preventDefault();
          let projects_area = $('.todolist-projects-js');
          let name = $('input[name=store_project_name]').val();
          let action = $('.store_project_form-js').attr('action');
          $.ajax({
            url: action,
            type: 'POST',
            data: {
              name: name
            },
            headers: {
              'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
              projects_area.append(data.contents);
              hideModal(modal);
            }
          });
        });
        emptyHiddenModal(modal);
      }
    });
  });
}

function edit() {
  $(document).on('click', '.button-open-edit-project-modal-js', function(e) {
    e.preventDefault();
    let form = $(this).closest('.edit-project-form-js');
    let title = $(form).closest('.div-project-js').find('span.panel-title');
    let action = $(form).attr('action');
    let modal = $('#edit_project_modal');
    $.ajax({
      url: action,
      type: 'GET',
      data: {
        name: name
      },
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (data) {
        modal.append(data.contents);
        // update(title, modal);
        emptyHiddenModal(modal);
      }
    });
  });
}

function update(title, modal) {
  $('.button-update-project-js').click(function(e) {
    e.preventDefault();
    let name = $('input[name=update_project_name]').val();
    let action = $('.update_project_form-js').attr('action');
    let method = 'PUT';
    let data = {
      name: name
    };
    ajaxRequest(action, method, data, handleUpdateResponse(title, name, modal));
  });
}

function destroy() {
  $(document).on('click', '.button-destroy-project-js', function(e) {
    e.preventDefault();
    let form = this.closest('.destroy_project_form-js');
    let action = $(form).attr('action');
    let method = 'DELETE';
    let project_div = this.closest('.div-project-js');
    ajaxRequest(action, method, null, handleDestroyResponse(project_div));
  });
}
