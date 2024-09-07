$(document).ready(function() {
  function getUsers(url) {
      $.ajax({
          url: url, // Đường dẫn tới tuyến đường xử lý yêu cầu AJAX
          method: 'GET',
          dataType: 'json',
          success: function(response) {
              // Xử lý dữ liệu người dùng ở đây
              console.log(response);
          },
          error: function(xhr, status, error) {
              console.error('There was an error!', error);
          }
      });
  }

  // Gọi hàm getUsers khi trang được tải
  getUsers('/users');
});