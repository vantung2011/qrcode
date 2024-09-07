$(document).ready(function() {
    $('#addEmployeeForm').submit(function(event) {
        event.preventDefault();
        var formData = {
            name: $('#name').val(),
            email: $('#email').val(),
            username: $('#username').val(),
        };
        $.ajax({
            url: '/users',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                $('#success-message').text('Tạo user thành công!').show();
                $('.table').load(location.href + ' .table');
                $('#addEmployeeModal').modal('hide');
                setTimeout(function() {
    $('#success-message').fadeOut();
}, 1000);
            },
            error: function(xhr, status, error) {
                // Xử lý lỗi
                var errors = xhr.responseJSON.errors;
                console.log(errors);
                $.each(errors, function(key, value) {
                    $('#' + key + '-error').text(
                    value); // Hiển thị lỗi dưới chân mỗi ô nhập liệu
                    $('#' + key + '-error').show(); // Hiển thị thông báo lỗi
                });
            }
        });
    });
});
$('#addEmployeeForm input').focus(function() {
    var fieldName = $(this).attr('name');
    $("#" + fieldName + "-error").text('');
});