$(document).ready(function() {
    $('.edit').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var email = $(this).data('email');
        var username = $(this).data('username');
        var salary = $(this).data('salary');
        $('#editId').val(id);
        $('#editName').val(name);
        $('#editEmail').val(email);
        $('#editUsername').val(username);
        $('#editSalary').val(salary);
    });
  
    $('#editEmployeeForm').submit(function(event) {
        event.preventDefault();
        var formData = {
            editName: $('#editName').val(),
            editEmail: $('#editEmail').val(),
            editUsername: $('#editUsername').val(),
            editSalary: $('#editSalary').val(),
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
                $('.table').load(location.href + ' .table');
                $('#editEmployeeForm').find('input').val('');
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