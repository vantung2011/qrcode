@extends('layouts.app')
@section('content')
    <div class="container shadow-lg rounded p-3 mb-3">
        <div class="dashboard_container">
            <div class="dashboard_container_header">
                <div class="dashboard_fl_1">
                    <h4>Thông tin cá nhân</h4>
                </div>
            </div>
            <div class="dashboard_container_body p-4">
                <form id="profileForm">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" id="user_id" name="id" value="{{ $user->id }}">
                    <div class="submit-section row">
                        <div class="col-7">
                            <div class="form-group col-md-6">
                                <label>Họ tên</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $user->name }}">
                                <span class="text-danger" id="name-error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    value="{{ $user->username }}">
                                <span class="text-danger" id="username-error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" id = "email" name="email" class="form-control"
                                    value="{{ $user->email }}" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <button id="updateProfile" class="btn btn-dark mt-2" type="submit">Cập nhật</button>
                            </div>
                        </div>
                        <div id="qrcode" class="col-3"></div>
                    </div>
                </form>
                <h5 style="color: black">Lương: {{ $user->salary }}/giờ</h5>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="table-wrapper h-200 shadow-lg mt-8">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2><b>Lịch sử chấm công</b></h2>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width: 10%;">STT</th>
                        <th style="width: 25%;">Name</th>
                        <th style="width: 25%;">CheckIn</th>
                        <th style="width: 25%;">CheckOut</th>
                        <th style="width: 10%;">Ngày làm </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Các dòng của bảng -->
                    @foreach ($userScans as $key => $userScan)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $userScan->user->name }}</td>
                            <td>{{ $userScan->created_at }}</td>
                            <td>
                                @if ($userScan->updated_at)
                                    {{ $userScan->check_out }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $userScan->created_at->format('d/m') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- password --}}
    {{-- ---------------------------------------------------------------- --}}
    {{-- <div class="container shadow-lg rounded p-3 mb-3">
  <div class="dashboard_container">
      <div class="dashboard_container_header">
          <div class="dashboard_fl_1">
              <h4>Đổi mật khẩu</h4>
          </div>
      </div>
      <div class="dashboard_container_body p-4">
        <form id="passwordForm">
            @csrf
            @method('PATCH')
              <div class="submit-section">
                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <label>Mật khẩu cũ</label>
                          <input type="password" name="old_password" class="form-control" >
                      </div>
                      <div class="form-group col-md-6">
                          <label>Mật khẩu mới</label>
                          <input type="password" name="password" class="form-control" >
                      </div>
                                            <div class="form-group col-md-6">
                          <label>Mật khẩu mới</label>
                          <input type="password" name="confirmed_password" class="form-control" >
                      </div>
                      <div class="form-group col-md-12">
                          <button class="btn btn-dark mt-2" type="submit">Cập nhật</button>
                      </div>
                  </div>
              </div>
          </form>
      </div>
  </div>
</div> --}}
    <script>
        $(document).ready(function() {
            $('form').on('submit', function(event) {
                event.preventDefault();
                var id = $('#user_id').val();
                var name = $('#name').val();
                var username = $('#username').val();

                $.ajax({
                    url: '/profile/' + id,
                    type: 'PATCH',
                    dataType: 'json',
                    data: {
                        name: name,
                        username: username,
                    },
                    success: function(response) {
                        console.log(response);
                        alert('Cập nhật thông tin người dùng thành công!');
                        $('.item-name').load(location.href + ' .item-name');
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key + '-error').text(value);
                            var fieldName = value;
                            var spanElement = document.getElementById(key + '-error');
                            // spanElement.textContent = spanElement.textContent.replace(/edit/g, '');
                        });
                    }
                });
            });
        });
        $('form input').focus(function() {
            var fieldName = $(this).attr('name');
            $("#" + fieldName + "-error").text('');
        });
    </script>
    <script>
        function generateQR() {
            var inputValue = $('#email').val().trim();
            if (inputValue === '') {
                $('#qrcode').empty();
                return;
            }
            $('#qrcode').empty();
            $('#qrcode').qrcode({
                text: inputValue
            });
        }
        $(document).ready(function() {
            $('#qrInput').on('input', generateQR);
        });
        generateQR();
    </script>
@endsection
