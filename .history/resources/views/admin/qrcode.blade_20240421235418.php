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
document.getElementById('formQrCode').addEventListener('submit', function(event) {
  event.preventDefault();

  // Get form data
  const qrcodeData = document.getElementById('qrcodeData').value;

  // Create FormData object (optional, if server-side expects multipart form data)
  // const formData = new FormData();
  // formData.append('qrcodeData', qrcodeData);

  fetch('/qrcode', {
    method: 'POST',
    // Use FormData if needed
    // body: formData,
    body: JSON.stringify({ qrcodeData }), // Assuming JSON data is expected
    headers: {
      'Content-Type': 'application/json' // Set content type for JSON data
    }
  })
  .then(response => response.json())
  .then(response => {
    console.log(response);
  })
  .catch(error => {
    console.error(error);
  });
});
</script>
@endsection
