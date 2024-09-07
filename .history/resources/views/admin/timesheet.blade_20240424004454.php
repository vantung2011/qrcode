@extends('layouts.app')
@section('content')
<ul id="listContainer"></ul>
<script>
// Hàm để gửi yêu cầu Fetch API và xử lý dữ liệu
function fetchDataAndDisplay() {
    fetch('http://127.0.0.1:8000/api/timesheet')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Chuyển đổi dữ liệu nhận được sang JSON
        })
        .then(data => {
            // Sau khi nhận được dữ liệu, chúng ta sẽ xử lý và hiển thị nó
            displayDataInList(data);
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });
}

// Hàm để hiển thị dữ liệu trong danh sách
function displayDataInList(data) {
    const listContainer = document.getElementById('listContainer');

    // Xóa các phần tử hiện có trong danh sách (nếu có)
    listContainer.innerHTML = '';

    // Duyệt qua mảng dữ liệu và tạo các phần tử <li> để thêm vào danh sách
    data.forEach(item => {
        const listItem = document.createElement('li');
        listItem.textContent = item.name; // Thay 'name' bằng thuộc tính của đối tượng bạn muốn hiển thị

        // Thêm phần tử <li> vào trong danh sách
        listContainer.appendChild(listItem);
    });
}

// Gọi hàm fetchDataAndDisplay để lấy và hiển thị dữ liệu khi trang web được tải
fetchDataAndDisplay();
</script>
@endsection