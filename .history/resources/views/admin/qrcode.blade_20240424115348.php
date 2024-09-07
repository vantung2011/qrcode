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
    var isFormReady = false;
    // Khởi tạo HTML5-QRCode scanner và xử lý sự kiện quét thành công
    var html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess);

    // Hàm xử lý khi quét QR code thành công
    function onScanSuccess(qrcodeData) {
        // Điền dữ liệu vào ô input
        $('#qrcodeData').val(qrcodeData);

        // Nếu form đã sẵn sàng, tự động submit form
        if (isFormReady) {
            $('#formQrCode').submit();
        } else {
            // Nếu form chưa sẵn sàng, đánh dấu rằng form đã sẵn sàng
            isFormReady = true;
        }
    }

    // Xử lý sự kiện submit của form
    $('#formQrCode').submit(function(event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của form (không reload trang)

        // Thu thập dữ liệu từ form
        var formData = {
            qrcodeData: $('#qrcodeData').val(),
        };

        // Gửi yêu cầu POST đến server qua AJAX
        $.ajax({
            url: '/qrcode',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                consolog.log(response);
                $('#success-message').text('Success!').show();
                setTimeout(function() {
                    $('#success-message').fadeOut();
                }, 1000);
            },
            error: function(xhr, status, error) {
                // Xử lý lỗi khi gửi yêu cầu đến server
                $('#error-message').text('Đã có lỗi xảy ra, vui lòng thử lại.').show();
                setTimeout(function() {
                    $('#error-message').fadeOut();
                }, 1000);
            }
        });
    });
});
</script>
@endsection
