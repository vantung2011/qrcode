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
     var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 20, qrbox: 300 }
    );

    html5QrcodeScanner.render(onScanSuccess);

    function onScanSuccess(qrcodeData) {
        // Đặt giá trị QR code vào trường input
        document.getElementById("qrcodeData").value = qrcodeData;

        // Gọi hàm xử lý gửi dữ liệu form
        handleFormSubmit();
    }

    // Sử dụng sự kiện input để tự động gọi hàm xử lý gửi dữ liệu form khi có sự thay đổi trong trường input
    document.getElementById("qrcodeData").addEventListener("input", function() {
        handleFormSubmit();
    });

    // Hàm xử lý gửi dữ liệu form bằng Ajax
    function handleFormSubmit() {
        var formData = $('#formQrCode').serialize(); // Lấy dữ liệu từ form

        $.ajax({
            url: '/your-endpoint-url', // Thay thế bằng đường dẫn tới endpoint của bạn
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                $('#success-message').text('Quét thành công').show().delay(1000).fadeOut();
            },
            error: function(xhr, status, error) {
                console.error(error);
                $('#error-message').text('Đã xảy ra lỗi. Vui lòng thử lại.').show().delay(1000).fadeOut();
            }
        });
    }
</script>
@endsection
