
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
<div style="width: 500px" id="reader"></div>
<form id="formQrCode" method="post" >
  @csrf
    <input type="submit"  id="qrcode">
    {{-- style="visibility: hidden" --}}
</form>
<input type="text" id="qrcodeData" name="qrcodeData"  >
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
        document.getElementById("myForm").submit();
    }, 1000);
    html5QrcodeScanner.clear();
}
$(document).ready(function() {
    $('#formQrCode').submit(function(event) {
        event.preventDefault();
        var formData = {
            name: $('#qrcodeData').val(),
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
}, 500);},
            error: function(xhr, status, error) {
                var errors = xhr.responseJSON.errors;
            }
        });
    });
});
</script>
<style>
    body {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 0;
  padding: 0;
  height: 100vh;
  background-color: #f0f0f0;
}

.container {
  width: 100%;
  max-width: 500px;
  margin: 5px;
}

.container h1 {
  color: #333;
}

.section {
  background-color: #fff;
  padding: 30px;
  border: 1.5px solid #b2b2b2;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

#my-qr-reader {
  padding: 20px;
  border: 1.5px solid #b2b2b2;
  border-radius: 8px;
}

#my-qr-reader img[alt="Info icon"] {
  display: none;
}

#my-qr-reader img[alt="Camera based scan"] {
  width: 100px;
  height: 100px;
}

button {
  padding: 10px 20px;
  border: 1px solid #b2b2b2;
  outline: none;
  border-radius: 8px;
  color: white;
  font-size: 15px;
  cursor: pointer;
  margin-top: 15px;
  margin-bottom: 10px;
  background-color: #008000ad;
  transition: 0.3s background-color;
}

button:hover {
  background-color: #008000;
}

#html5-qrcode-anchor-scan-type-change {
  text-decoration: none;
  color: #1d9bf0;
}

video {
  width: 100%;
  border: 1px solid #b2b2b2;
  border-radius: 8px;
}
#html5-qrcode-select-camera{
  display: none;
}
#reader__dashboard_section_csr span:nth-child(2) {
  display: none;
}
</style>
