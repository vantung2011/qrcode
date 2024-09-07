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
    <input type="submit"  id="qrcode" style="opacity: 0">
    <input type="text" id="qrcodeData" name="qrcodeData" readonly  style="opacity: 0">
    {{-- style="visibility: hidden" --}}
</form>
</div>
<script>
$(document).ready(function() {
    var isFormReady = false; // Biến để kiểm tra xem form đã sẵn sàng để submit chưa

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 10, qrbox: 250 }
    );

    html5QrcodeScanner.render(function onScanSuccess(qrcodeData) {
        document.getElementById("qrcodeData").value = qrcodeData;
        
        if (isFormReady) {
            submitForm(); // Nếu form đã sẵn sàng, thực hiện submit
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
                }, 1000);
            },
            error: function(xhr, status, error) {
                $('#error-message').text('Đã có lỗi xảy ra xin vui lòng thử lại').show();
                setTimeout(function() {
                    $('#error-message').fadeOut();
                }, 1000);
            }
        });
    }

    // Bind sự kiện submit của form
    $('#formQrCode').submit(function(event) {
        event.preventDefault();

        if (!isFormReady) {
            isFormReady = true;
        } else {
            submitForm(); 
        }
    });
});
</script>
@endsection
