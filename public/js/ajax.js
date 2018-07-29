function ajaxRequest(action, method, data, successResponse) {
  $.ajax({
    url: action,
    type: method,
    data: data,
    headers: {
      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (data) {
      successResponse;
    }
  });
}

function hideModal(modal_id) {
  $(modal_id).empty();
  $(modal_id).modal('hide');
  $('.modal-backdrop').remove();
}

function emptyHiddenModal(modal_id) {
  $(modal_id).on('hidden.bs.modal', function () {
    $(modal_id).empty();
  });
}

function btnHideShow(btn_hide, btn_show) {
  btn_hide.hide();
  btn_show.show();
}

function setError(form, data) {
  let response = data.responseJSON;
  let error = response.errors['name'];
  let error_container = $(form).find('.errors-container-js');
  error_container.addClass('form-errors');
  error_container.html(error);
}

function emptyErrorContainer(form) {
  let error_container = $(form).find('.errors-container-js');
  error_container.removeClass('form-errors')
  error_container.empty();
}
