$(document).ready(function() {
  // Hàm lấy dữ liệu người dùng
  function getUsers(url) {
      $.ajax({
          url: url,
          method: 'GET',
          dataType: 'json',
          success: function(response) {
              // Xử lý dữ liệu người dùng và phân trang
              var users = response.users.data;
              var pagination = response.pagination;

              // Hiển thị dữ liệu người dùng
              $('#users').empty();
              $.each(users, function(index, user) {
                  $('#users').append('<li>' + user.name + ' - ' + user.email + ' - ' + user.username + '</li>');
              });

              // Hiển thị phân trang
              $('#pagination').empty();
              if (pagination.prev_page_url) {
                  $('#pagination').append('<button onclick="getUsers(\'' + pagination.prev_page_url + '\')">Previous</button>');
              }
              if (pagination.next_page_url) {
                  $('#pagination').append('<button onclick="getUsers(\'' + pagination.next_page_url + '\')">Next</button>');
              }
          },
          error: function(xhr, status, error) {
              console.error('There was an error!', error);
          }
      });
  }

  // Gọi hàm lấy dữ liệu người dùng khi trang được tải
  getUsers('/users');
});
