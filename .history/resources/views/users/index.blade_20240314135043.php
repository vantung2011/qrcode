@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@section('content')
{{-- {{dd($users)}} --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Họ Tên</th>
            <th scope="col">Email</th>
            <th scope="col">Tên đăng nhâp</th>
        </tr>
    </thead>
    <tbody id="user-table-body">
        @foreach ($users as $user)
        <tr>
            <th scope="row">{{$user['id']}}</th>
            <td>{{$user['name']}}</td>
            <td>{{$user['email']}}</td>
            <td>{{$user['username']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination-link">
    {{ $users->links() }}
</div>
@endsection

<script>
    $(document).ready(function() {
        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            getUsers(url);
        });

        function getUsers(url) {
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html',
                success: function(response) {
                    $('#user-table-body').html($(response).find('#user-table-body').html());
                    $('.pagination-link').html($(response).find('.pagination-link').html());
                }
            });
        }
    });
</script>