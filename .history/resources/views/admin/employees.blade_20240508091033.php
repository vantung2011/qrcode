@extends('layouts.app')
@section('content')
    @include('admin.add_user')
    @include('admin.edit_user')
    <div class="table-data">
        @include('admin.pagination')
    </div>
    <script type="text/javascript">
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            page1(page)
        })

        function page1(page) {
            $.ajax({
                url: "/ajax-paginate?page=" + page,
                success: function(res) {
                    $('.table-data').html(res);
                }
            })
        }
        $(document).ready(function() {
  $('.edit').click(function() {
      var id = $(this).data('id');
      var name = $(this).data('name');
      var email = $(this).data('email');
      var username = $(this).data('username');

      $('#editId').val(id);
      $('#editName').val(name);
      $('#editEmail').val(email);
      $('#editUsername').val(username);
  });});
    </script>
@endsection
