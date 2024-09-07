@extends('layouts.app')
@section('content')
<ul id="scanList"></ul>

<script>
$.get('http://127.0.0.1:8000/api/timesheet', function(data) {
    var scanList = $('#scanList');
    data.forEach(function(item) {
        // Tạo phần tử <li> mới
        var listItem = $('<li></li>');
        var scanInfo = `User ID: ${item.user_id}, Scan Time: ${item.scan_time}, Scan Type: ${item.scan_type}`;

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