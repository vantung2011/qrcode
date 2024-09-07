$(document).on('click', '.delete-user', function(e) {
  e.preventDefault();
  let userId = $(this).data('id');
  
  if (confirm('Bạn có chắc chắn xóa user')) {
      $.ajax({
          url: '/users/'+userId,
          method: 'delete',
          success: function(res) {
              alert('Xóa user thành công');
              $('.table').load(location.href + ' .table');
              $('.pagina').load(location.href + ' .pagina');
              location.reload();
          }
      });
  }
});