@extends('layouts.app')
@section('content')
<ul id="scanList">
</ul>
<script>
$.ajax({
    url: 'api/timesheet',
    method: 'GET',
    dataType: 'json',
    success: function(data) {
        console.log('Dữ liệu nhận được:', data);
    },
    error: function(xhr, status, error) {
        console.error('Đã xảy ra lỗi:', error);
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
        });
    }
});

</script>
@endsection