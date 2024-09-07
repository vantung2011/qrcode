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

        axios.patch('/users/' + userId, formData)
            .then(function(response) {
                console.log(response);
                $('#editEmployeeModal').modal('hide');
                alert('Cập nhật thông tin người dùng thành công!');
                $('td').load(location.href + ' td');
            })
            .catch(function(error) {
                // Xử lý lỗi nếu có
                console.error(error.response.data);
                var errors = error.response.data.errors;
                $.each(errors, function(key, value) {
                    $('#' + key + '-error').text(value);
                    var fieldName = value;
                    var spanElement = document.getElementById(key + '-error');
                    spanElement.textContent = spanElement.textContent.replace(/edit/g, '');
                });
            });
    });
});

$('#editEmployeeForm input').focus(function() {
    var fieldName = $(this).attr('name');
    $("#" + fieldName + "-error").text('');
});
