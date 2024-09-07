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
    var isSubmitting = false; // Biến để kiểm soát trạng thái gửi dữ liệu

    $('#formQrCode').submit(function(event) {
        event.preventDefault();

        if (!isSubmitting) { // Kiểm tra xem có đang gửi dữ liệu không
            var formData = {
                qrcodeData: $('#qrcodeData').val(),
            };

            // Đặt trạng thái đang gửi là true để tránh gửi lặp lại
            isSubmitting = true;

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

                    // Đặt lại trạng thái gửi về false sau khi xử lý thành công
                    isSubmitting = false;
                },
                error: function(xhr, status, error) {
                    $('#error-message').text('Đã có lỗi xảy ra xin vui lòng thử lại').show();
                    setTimeout(function() {
                        $('#error-message').fadeOut();
                    }, 1000);

                    // Đặt lại trạng thái gửi về false sau khi xử lý lỗi
                    isSubmitting = false;
                }
            });
        }
    });

    function onScanSuccess(qrcodeData) {
        document.getElementById("qrcodeData").value = qrcodeData;

        // Kiểm tra và gửi form nếu chưa có quá trình gửi dữ liệu đang diễn ra
        if (!isSubmitting) {
            // Đặt trạng thái đang gửi là true để tránh gửi lặp lại
            isSubmitting = true;

            setTimeout(function() {
                document.getElementById("formQrCode").submit();

                // Đặt lại trạng thái gửi về false sau khi gửi form
                isSubmitting = false;
            }, 1000);
        }
    }
});
</script>
@endsection
