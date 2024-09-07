@extends('layouts.app')
@section('content')
<div class="container">
  <div class="table-wrapper h-200 shadow-lg mt-8">
      <div class="table-title">
          <div class="row">
              <div class="col-sm-6">
                  <h2><b>Lich làm việc</b></h2>
              </div>
          </div>
      </div>
      <div class="col-sm-6">
        <a href="#addEmployeeModal" class="btn btn-success" data-bs-toggle="modal">
            <i class="material-icons">&#xE147;</i> <span>Thêm nhân viên</span>
        </a>
    </div>
      <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th style="width: 10%;">STT</th>
              <th style="width: 25%;">Name</th>
              <th style="width: 25%;">Ca làm</th>
              <th>Thời gian</th>
            </tr>
          </thead>
          <tbody>
              <!-- Các dòng của bảng -->
              @foreach($schedules as $key => $schedule)
      <tr>
        <td>{{ $loop->index+1 }}</td>
        <td>{{$schedule->user_name}}</td>
        <td>Ca {{$schedule->shift_name}}</td>
        <td>{{$schedule->start_time}} - {{$schedule->end_time}}</td>
        {{-- <td><a href="#salaryPayment" class="edit" data-bs-toggle="modal" data-status="{{ $userScan->status }}" data-id="{{ $userScan->id}}" data-name="{{ $userScan->name }}" data-month="{{ $userScan->month }}" data-work_hour="{{$userScan->work_hours}}" data-email="{{ $userScan->email }}" data-salary="{{ $userScan->salary_amount }}">
          <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
      </a></td> --}}
      </tr>
      <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addEmployeeForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" class="form-control" name="name" placeholder = "" id="name">
                            <span class="text-danger" id="name-error"></span> <!-- Thêm span để hiển thị lỗi -->
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" id="email">
                            <span class="text-danger" id="email-error"></span> <!-- Thêm span để hiển thị lỗi -->
                        </div>
                        <div class="form-group">
                            <label>Tên đăng nhập</label>
                            <input type="text" class="form-control" name="username" id="username">
                            <span class="text-danger" id="username-error"></span> <!-- Thêm span để hiển thị lỗi -->
                        </div>
                        <div class="form-group">
                            <label>Lương</label>
                            <input type="text" class="form-control" name="salary" id="salary">
                            <span class="text-danger" id="salary-error"></span> <!-- Thêm span để hiển thị lỗi -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-toggle="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
      </div>
      </div>
      @endforeach

          </tbody>
        </table>
  </div> 
</div>
<div>
  <script>
    $(document).ready(function() {
        $('.edit').click(function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var month = $(this).data('month');
            var work_hour = $(this).data('work_hour');
            var salary = $(this).data('salary');
            var status = $(this).data('status');
            
            // Set values to respective elements
            $('#id').val(id);
            $('#name').text(name);
            $('#email').text(email);
            $('#month').text(month);
            $('#work_hour').text(work_hour);
            $('#salary').text(salary);
            $('#status').val(status);
            $('#hiddenStatus').val(status);
        });

        $('form').on('submit', function(event) {
            event.preventDefault();
            var id = $('#id').val();
            var formData = {
                status: $('#hiddenStatus').val(),
            };
            $.ajax({
                url: '/salary/' + id, 
                type: 'PATCH',
                data: formData, 
                dataType: 'json', 
                success: function(response) {
                    console.log(response);
                    $('#editEmployeeModal').modal('hide');
                    alert('Cập nhật thông tin người dùng thành công!');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Đã xảy ra lỗi khi cập nhật thông tin người dùng!');
                }
            });
        });
    });
    function updateHiddenStatus() {
        var selectedStatus = $('#statusDropdown').val();
        $('#hiddenStatus').val(selectedStatus);
    }
</script>
@endsection