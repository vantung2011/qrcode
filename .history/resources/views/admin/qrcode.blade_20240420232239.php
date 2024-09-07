
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
$(document).ready(function() {
    $('#addEmployeeForm').submit(function(event) {
        event.preventDefault();
        var formData = {
            name: $('#name').val(),
            email: $('#email').val(),
            username: $('#username').val(),
        };
        $.ajax({
            url: '/users',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                $('#success-message').text('Tạo user thành công!').show();
                $('.table').load(location.href + ' .table');
                $('#addEmployeeModal').modal('hide');
                setTimeout(function() {
    $('#success-message').fadeOut();
}, 1000);
            },
            error: function(xhr, status, error) {
                console.log(err);
            }
        });
    });
});
</script>
