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
    }
});

</script>
@endsection