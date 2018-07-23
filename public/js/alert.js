function alertSuccess(phrase) {
  let alert_container = $('.alert-success-js');
  let message_container = $('.success-message-js');
  alert(alert_container, message_container, phrase);
}

function alert(alert_container, message_container, phrase) {
  alert_container.toggleClass('hidden');
  message_container.html(phrase);
  setInterval(function(){
    alert_container.addClass('hidden');
    message_container.html('');
  }, 2000);
}

let success_phrases = {
  project_store: 'Project was created successfully!',
  project_update: 'Project was updated successfully!',
  project_destroy: 'Project was deleted successfully!',
  task_store: 'Task was created successfully!',
  task_update: 'Task was updated successfully!',
  task_destroy: 'Task was deleted successfully!',
  task_status: 'Task status was changed successfully!'
}
