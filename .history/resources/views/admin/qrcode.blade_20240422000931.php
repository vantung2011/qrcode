@extends('layouts.app')
@section('content')
{{-- <div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
@vite(['resources/css/qrcode.css'])
<div class=" alert alert-success" style="display: none;">Success!</div>
<div class=" alert alert-danger" style="display: none;">Error</div>
<div style="width: 500px" id="reader"></div>
<div id="success-message" class="alert alert-success text-center" style="display: none;"></div>
<form id="formQrCode" method="post" >
  @csrf
    <input type="submit"  id="qrcode">
    <input type="text" id="qrcodeData" name="qrcodeData"  >
    {{-- style="visibility: hidden" --}}
{{-- </form>
</body>
</html>
</div> --}} --}}
{{-- <script>
  var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 }
);

html5QrcodeScanner.render(onScanSuccess);

function onScanSuccess(qrcodeData) {
    document.getElementById("qrcodeData").value = qrcodeData;
    setTimeout(function() {
        document.getElementById("").submit();
    }, 1000);
    html5QrcodeScanner.clear();
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
                console.log(response);
               },
            error: function(xhr, status, error) {
                var errors = xhr.responseJSON.errors;
                console.log(errors);
            }
        });
    });
});
</script> --}}
@endsection
