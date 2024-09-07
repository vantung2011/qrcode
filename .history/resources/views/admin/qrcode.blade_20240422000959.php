@extends('layouts.app')
@section('content')

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
