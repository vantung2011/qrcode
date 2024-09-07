@extends('layouts.app')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
<div id="success-message" class="alert alert-success text-center" style="display: none;"></div>
<h3 id="error-message" class=" alert alert-danger text-center" style="display: none;"></h3>
@vite(['resources/css/qrcode.css'])
<div class="body d-flex flex-column ">
    <form id="formQrCode" method="post" >
        @csrf
          <input type="submit"  id="qrcode" style="opacity: 0">
          <input type="text" id="qrcodeData" name="qrcodeData"  style="opacity: 0">
          {{-- style="visibility: hidden" --}}
      </form>
<div style="width: 500px" id="reader"></div>
</div>
<script>
$(document).ready(function() {
    var isFormReady = false;
    var html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess);

    function onScanSuccess(qrcodeData) {
        $('#qrcodeData').val(qrcodeData);

        if (isFormReady) {
            $('#formQrCode').submit();
        } else {
            isFormReady = true;
        }
    }

    // Xử lý sự kiện submit của form
    $('#formQrCode').submit(function(event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của form (không reload trang)

        var formData = {
            qrcodeData: $('#qrcodeData').val(),
        };
        $.ajax({
            url: '/qrcode',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                $('#success-message').text('Quét thành công').show();
                setTimeout(function() {
                    $('#success-message').fadeOut();
                }, 2000);
            },
            error: function(xhr, status, error) {
                $('#error-message').text('Thất bại').show();
                setTimeout(function() {
                    $('#error-message').fadeOut();
                }, 2000);
            }
        });
    });
});
</script>
@endsection
