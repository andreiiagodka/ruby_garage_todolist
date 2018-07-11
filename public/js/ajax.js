$(document).ready(function() {
  $('.button-open-create-project-modal-js').click(function(e) {
    e.preventDefault();
    let action = $('.create-project-form-js').attr('action');
    let method = $('.create-project-form-js').attr('method');
    $.ajax({
      url: action,
      type: method,
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
          let method = $('.store_project_form').attr('method');
          $.ajax({
            url: action,
            type: method,
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

        $('.button-close-modal-js').click(function() {
          $('.create_project_modal-js').empty();
          $('#create_project_modal').modal('hide');
        });
      }
    });
  });



  // $('.button-edit-project-js').click(function(e) {
  //   e.preventDefault();
  //   let project_name = $('input[name=edit_project_name]').val();
  //   let action = $('.edit_project_form').attr('action');
  //   $.ajax({
  //     url: action,
  //     type: 'POST',
  //     data: {
  //       project_name: project_name
  //     },
  //     headers: {
  //       'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
  //     },
  //     success: function (data) {
  //       $('#create_project_modal').modal('hide');
  //     }
  //   });
  // });

  // $('.button-delete-project-js').click(function(e) {
  //   e.preventDefault();
  //   let project_name = $('input[name=edit_project_name]').val();
  //   let action = $('.edit_project_form').attr('action');
  //   $.ajax({
  //     url: action,
  //     type: 'POST',
  //     data: {
  //       project_name: project_name
  //     },
  //     headers: {
  //       'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
  //     },
  //     success: function (data) {
  //       $('#create_project_modal').modal('hide');
  //     }
  //   });
  // });
});
