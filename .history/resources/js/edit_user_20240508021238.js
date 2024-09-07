$(document).ready(function() {
  $('.edit').click(function() {
    // $('#editName').val('');
    // $('#editEmail').val('');
    // $('#editUsername').val('');
      var id = $(this).data('id');
      var name = $(this).data('name');
      var email = $(this).data('email');
      var username = $(this).data('username');

      $('#editId').val(id);
      $('#editName').val(name);
      $('#editEmail').val(email);
      $('#editUsername').val(username);
  });

  $('#editEmployeeForm').submit(function(event) {
      event.preventDefault();
      var formData = {
          editName: $('#editName').val(),
          editEmail: $('#editEmail').val(),
          editUsername: $('#editUsername').val(),
      };
      var userId = $('#editId').val();

      $.ajax({
          url: '/users/' + userId,
          type: 'PATCH',
          data: formData, 
          dataType: 'json', 
          success: function(response) {
              console.log(response);
              $('#editEmployeeModal').modal('hide');
              alert('Cập nhật thông tin người dùng thành công!');
              $('#editEmployeeModal').load(location.href + ' #editEmployeeModal');
              $('.table').load(location.href + ' .table');
          },
          error: function(xhr, status, error) {
              // Xử lý lỗi nếu có
              console.error(xhr.responseText);
              var errors = xhr.responseJSON.errors;
              $.each(errors, function(key, value) {                    
                  $('#' + key + '-error').text(value);
                  var fieldName = value;
              var spanElement = document.getElementById(key+'-error');
              spanElement.textContent = spanElement.textContent.replace(/edit/g, '');
              });
          }
      });
  });
});
$('#editEmployeeForm input').focus(function() {
  var fieldName = $(this).attr('name');
  $("#" + fieldName + "-error").text('');
});