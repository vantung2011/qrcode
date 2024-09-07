@extends('layouts.app')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
<div id="success-message" class="alert alert-success text-center" style="display: none;"></div>
<div id="error-message" class=" alert alert-danger" style="display: none;">Success!</div>
@vite(['resources/css/qrcode.css'])
<div class="body">
<div style="width: 500px" id="reader"></div>
<form id="formQrCode" method="post" >
  @csrf
    <input type="submit"  id="qrcode">
    <input type="text" id="qrcodeData" name="qrcodeData"  >
    {{-- style="visibility: hidden" --}}
</form>
</div>
<script>
  var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 }
);

html5QrcodeScanner.render(onScanSuccess);

function onScanSuccess(qrcodeData) {
    document.getElementById("qrcodeData").value = qrcodeData;
    setTimeout(function() {
        document.getElementById("").submit();
    }, 1000);
}
$(document).ready(function() {
    $('#formQrCode').submit(function(event) {
        event.preventDefault();
        var formData = {
            qrcodeData : $('#qrcodeData').val(),
        };
        $.ajax({
            url: '/qrcode',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                $('#success-message').text('Success!').show();
                $('#error-message').hide();
               },
            error: function(xhr, status, error) {
                $('#error-message').text('Đã có lỗi xảy ra xin vui lòng thử lại').show();
                $('#success-message').hide();
            }
        });
    });
});
</script>
@php
$now = Carbon::now();
$hour = $now->hour;
echo $hour; // Hiển thị giờ hiện tại

// Lấy phút hiện tại
$minute = $now->minute;
echo $minute; // Hiển thị phút hiện tại

// Lấy giây hiện tại
$second = $now->second;
echo $second;    
@endphp
@endsection
