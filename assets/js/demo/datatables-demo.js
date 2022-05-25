// Call the dataTables jQuery plugin
$(document).ready(function () {
  $('#dataTable').DataTable({
    buttons: [
      'copy', 'excel', 'pdf'
    ]
  });
});