@extends('layouts.app')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
<div id="success-message" class="alert alert-success text-center" style="display: none;"></div>
<div id="error-message" class=" alert alert-danger text-center" style="display: none;"></div>
@vite(['resources/css/qrcode.css'])
<div class="body">
<div style="width: 500px" id="reader"></div>
<form id="formQrCode" method="post" >
  @csrf
    <input type="submit"  id="qrcode">
    <input type="text" id="qrcodeData" name="qrcodeData">
    {{-- style="visibility: hidden" --}}
</form>
</div>
<script>
$(document).ready(function() {
    var isFormReady = false; // Biến để kiểm tra xem form đã sẵn sàng để submit chưa

    // Khởi tạo và render HTML5 QR Code Scanner
    var html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });

    // Callback khi quét thành công
    html5QrcodeScanner.render(function(qrcodeData) {
        if (!isFormReady) {
            isFormReady = true; // Đánh dấu rằng form đã sẵn sàng để submit
            submitForm(qrcodeData); // Thực hiện submit form khi quét thành công và form sẵn sàng
        }
    });

    // Hàm để thực hiện submit form
    function submitForm(qrcodeData) {
        var formData = {
            qrcodeData: qrcodeData,
        };

        $.ajax({
            url: '/qrcode',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                showMessage('success', 'Success!');
            },
            error: function(xhr, status, error) {
                showMessage('error', 'Đã có lỗi xảy ra xin vui lòng thử lại');
            }
        });
    }

    // Hàm để hiển thị thông báo thành công hoặc lỗi
    function showMessage(type, message) {
        var $messageElement = $('#' + type + '-message');
        $messageElement.text(message).show();
        setTimeout(function() {
            $messageElement.fadeOut();
        }, 1000);
    }

    // Bind sự kiện submit của form (nếu bạn muốn submit form bằng cách thủ công)
    $('#formQrCode').submit(function(event) {
        event.preventDefault();
        if (!isFormReady) {
            isFormReady = true; // Đánh dấu rằng form đã sẵn sàng để submit
            submitForm($('#qrcodeData').val()); // Thực hiện submit form khi submit bằng cách thủ công
        }
    });
});
</script>
@endsection
