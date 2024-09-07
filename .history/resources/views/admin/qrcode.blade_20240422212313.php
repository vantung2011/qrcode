@extends('layouts.app')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
<div id="success-message" class="alert alert-success text-center" style="display: none;"></div>
<div id="error-message" class=" alert alert-danger " style="display: none;"></div>
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
}
$(document).ready(function() {
    $('#formQrCode').submit(function(event) {
        event.preventDefault();
                   var inputData = $('#qrcodeData').val();
            if (inputData.trim() !== '') {
                $(this).unbind('submit').submit();
            }
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
    });
});
</script>
@endsection
