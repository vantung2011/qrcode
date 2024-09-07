@extends('layouts.app')
@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
@vite(['resources/css/qrcode.css'])
<div style="width: 500px" id="reader"></div>
<div id="success-message" class="alert alert-success text-center" style="display: none;"></div>
<form id="formQrCode" method="post" >
  @csrf
    <input type="submit"  id="qrcode">
    <input type="text" id="qrcodeData" name="qrcodeData"  >
    {{-- style="visibility: hidden" --}}
</form>
</body>
</html>
<script>
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
document.addEventListener('DOMContentLoaded', function() {
    var form = document.querySelector('#formQrCode');

    form.addEventListener('submit', function(event) {
        // Ngăn chặn hành động submit mặc định của form
        event.preventDefault();

        // Lấy giá trị của trường input với id là 'name'
        var userId = document.querySelector('#name').value;

        // Tạo đối tượng formData để lưu trữ dữ liệu cần gửi đi
        var formData = {
            user_id: userId
        };

        // Thực hiện yêu cầu fetch
        fetch('/qrcode', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(function(data) {
            // Xử lý dữ liệu nhận được khi yêu cầu thành công
            console.log(data);
        })
        .catch(function(error) {
            // Xử lý lỗi nếu yêu cầu thất bại
            console.error('Fetch error:', error);
        });
    });
});
</script>
@endsection
