@extends('layouts.app')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
<div id="success-message" class="alert alert-success text-center" style="display: none;"></div>
<div id="error-message" class=" alert alert-danger" style="display: none;"></div>
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
$(document).ready(function() {
    var isFormReady = false; // Biến để kiểm tra xem form đã sẵn sàng để submit chưa

    // Khởi tạo và render HTML5 QR Code Scanner
    var html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });

    // Callback khi quét thành công
    html5QrcodeScanner.render(function onScanSuccess(qrcodeData) {
        // Cập nhật giá trị của input #qrcodeData
        $('#qrcodeData').val(qrcodeData);

        // Kiểm tra nếu form đã sẵn sàng để submit
        if (isFormReady) {
            submitForm(); // Thực hiện submit form
        }
    });

    // Hàm để thực hiện submit form
    function submitForm() {
        var formData = {
            qrcodeData: $('#qrcodeData').val(),
        };

        $.ajax({
            url: '/qrcode',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                $('#success-message').text('Success!').show();
                setTimeout(function() {
                    $('#success-message').fadeOut();
                }, 2000);
            },
            error: function(xhr, status, error) {
                $('#error-message').text('Đã có lỗi xảy ra xin vui lòng thử lại').show();
                setTimeout(function() {
                    $('#error-message').fadeOut();
                }, 2000);
            }
        });
    }
    $(window).on('load', function() {
        isFormReady = true;
        submitForm();
    });
});
</script>
@endsection
