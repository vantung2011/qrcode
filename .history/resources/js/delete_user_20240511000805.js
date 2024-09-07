$(document).on('click', '.delete-user', function(e) {
  e.preventDefault();
  let userId = $(this).data('id');
  
  if (confirm('Bạn có chắc chắn xóa user')) {
      $.ajax({
          url: '/users/'+userId,
          method: 'delete',
          success: function(res) {
              alert('Xóa user thành công');
              $(".pagination").load(location.href + " .pagination");
$(".table").load(location.href + " .table");
          }
      });
  }
});