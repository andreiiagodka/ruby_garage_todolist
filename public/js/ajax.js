function ajaxRequest(action, method, data, handleResponse) {
  $.ajax({
    url: action,
    type: method,
    data: data,
    headers: {
      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (data) {
      handleResponse;
    }
  });
}

function handleUpdateResponse(name_container, name, modal) {
  $(name_container).html(name);
  hideModal(modal);
}

function handleDestroyResponse(container) {
  container.remove();
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
