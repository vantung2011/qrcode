@extends('layouts.app')
@section('content')
<ul id="scanList"></ul>

<script>
// Gửi yêu cầu AJAX để lấy dữ liệu từ API
$.get('http://127.0.0.1:8000/api/timesheet', function(data) {
    // Chọn phần tử <ul> trong HTML để hiển thị danh sách
    var scanList = $('#scanList');

    // Duyệt qua mảng dữ liệu và tạo các phần tử <li> cho mỗi mục
    data.forEach(function(item) {
        // Tạo phần tử <li> mới
        var listItem = $('<li></li>');

        // Tạo nội dung cho phần tử <li> từ dữ liệu của mục
        var scanInfo = `User ID: ${item.user_id}, Scan Time: ${item.scan_time}, Scan Type: ${item.scan_type}`;

        // Đặt nội dung của phần tử <li>
        listItem.text(scanInfo);

        // Thêm phần tử <li> vào trong danh sách
        scanList.append(listItem);
    });
})
.fail(function(xhr, status, error) {
    // Xử lý lỗi nếu yêu cầu thất bại
    console.error('Lỗi khi gửi yêu cầu AJAX:', error);
});

</script>
@endsection