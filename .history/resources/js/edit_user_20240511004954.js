$(document).ready(function() {
    $('.edit').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var email = $(this).data('email');
        var username = $(this).data('username');
        var salary = $(this).data('salary');
        document.getElementById('editId').value = id;
        document.getElementById('editName').value = name;
        document.getElementById('editEmail').value = email;
        document.getElementById('editUsername').value = username;
        document.getElementById('editSalary').value = salary;
    });

    document.getElementById('editEmployeeForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var formData = {
            editName: document.getElementById('editName').value,
            editEmail: document.getElementById('editEmail').value,
            editUsername: document.getElementById('editUsername').value,
            editSalary: document.getElementById('editSalary').value,
        };
        var userId = document.getElementById('editId').value;

        fetch('/users/' + userId, {
            method: 'PATCH',
            body: JSON.stringify(formData),
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            $('#editEmployeeModal').modal('hide');
            alert('Cập nhật thông tin người dùng thành công!');
            $('.table').load(location.href + ' .table');
        })
        .catch(error => {
            // Xử lý lỗi nếu có
            console.error(error);
        });
    });

    var inputs = document.querySelectorAll('#editEmployeeForm input');
    inputs.forEach(function(input) {
        input.addEventListener('focus', function() {
            var fieldName = this.getAttribute('name');
            $("#" + fieldName + "-error").text('');
        });
    });
});
