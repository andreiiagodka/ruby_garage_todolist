$(document).ready(function() {
  $('.button-open-create-project-modal-js').click(function(e) {
    e.preventDefault();
    let action = $('.create-project-form-js').attr('action');
    $.ajax({
      url: action,
      type: 'GET',
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (data) {
        $contents = data['contents'];
        $('.create_project_modal-js').append($contents);

        $('.button-store-project-js').click({$contents}, function(e) {
          e.preventDefault();
          let project_name = $('input[name=store_project_name]').val();
          let action = $('.store_project_form').attr('action');
          $.ajax({
            url: action,
            type: 'POST',
            data: {
              name: project_name
            },
            headers: {
              'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
              $contents = data['contents'];
              $('.todolist-projects-js').append($contents);
              $('.create_project_modal-js').empty();
              $('#create_project_modal').modal('hide');
            }
          });
        });

        $('#create_project_modal').on('hidden.bs.modal', function () {
          $('.create_project_modal-js').empty();
        });
      }
    });
  });


  $('.button-open-edit-project-modal-js').click(function(e) {
    e.preventDefault();
    let form = this.closest('.edit-project-form-js');
    let project_title = $(form).closest('.div-project-js').find('span.panel-title');
    let action = $(form).attr('action');
    $.ajax({
      url: action,
      type: 'GET',
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (data) {
        $contents = data['contents'];
        $('.edit_project_modal-js').append($contents);

        $('.button-update-project-js').click({$contents}, function(e) {
          e.preventDefault();
          let project_name = $('input[name=update_project_name]').val();
          let action = $('.update_project_form-js').attr('action');
          $.ajax({
            url: action,
            type: 'PUT',
            data: {
              name: project_name
            },
            headers: {
              'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
              project_title.html(project_name);
              $('.edit_project_modal-js').empty();
              $('#edit_project_modal').modal('hide');
            }
          });
        });

        $('#edit_project_modal').on('hidden.bs.modal', function () {
          $('.edit_project_modal-js').empty();
        });
      }
    });
  });

  $('.button-destroy-project-js').click(function(e) {
    e.preventDefault();
    let form = this.closest('.destroy_project_form-js');
    let action = $(form).attr('action');
    let project_div = this.closest('.div-project-js');
    $.ajax({
      url: action,
      type: 'DELETE',
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (data) {
        project_div.remove();
      }
    });
  });
});
