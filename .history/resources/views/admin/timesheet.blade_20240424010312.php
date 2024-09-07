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
        data.forEach(item => {
            const listItem = document.createElement('li');
            listItem.textContent = `User ID: ${item.user_id}, Scan Time: ${item.scan_time}, Scan Type: ${item.scan_type}`;
            dataList.appendChild(listItem);
        });
    }
});

</script>
@endsection