@extends('layouts.app')
@section('content')
<div class="container">
  <div class="table-wrapper h-200 shadow-lg mt-8">
      <div class="table-title">
          <div class="row">
              <div class="col-sm-6">
                  <h2><b>Bảng lương nhân viên</b></h2>
              </div>
          </div>
      </div>
      <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th style="width: 10%;">STT</th>
              <th style="width: 25%;">Name</th>
              <th style="width: 25%;">Tổng thời gian làm</th>
              <th>Tổng số tiền</th>
              <th>Thời gian</th>
              <th style="width: 10%;">Tình trạng </th>
            </tr>
          </thead>
          <tbody>
              <!-- Các dòng của bảng -->
              @foreach($userScans as $key => $userScan)
      <tr>
        <td>{{ $loop->index+1 }}</td>
        <td>{{ $userScan->name }}</td>
          <td>
            @if ($userScan->work_hours)
            {{$userScan->work_hours}} Giờ
            @else
                N/A
            @endif
        </td>
        <td>{{ $userScan->salary_amount }}</td>
        <td>{{ $userScan->month }}</td>
        <td>
          @if ($userScan->status == 1)
          <span class="badge text-bg-success">Đã thanh toán</span>
          @else
          <span class="badge text-bg-danger">Chưa thanh toán</span>
          @endif
        </td>
        <td><a href="#salaryPayment" class="edit" data-bs-toggle="modal" data-status="{{ $userScan->status }}" data-id="{{ $userScan->user_id }}" data-name="{{ $userScan->name }}" data-month="{{ $userScan->month }}" data-work_hour="{{$userScan->work_hours}}" data-email="{{ $userScan->email }}" data-salary="{{ $userScan->salary_amount }}">
          <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
      </a></td>
      </tr>
      <div id="salaryPayment" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content"> 
                <form method="GET" id="editEmployeeForm">
                  @csrf
                  @method('PATCH')
                    <div class="modal-header">
                      <h3>Thông tin</h3>
                      <input type="hidden" name="id" id="id">
                      <span class="text-danger" id="editId-error"></span>
                  </div>
                  <div class="modal-body">
                    <div class="mb-3">
                      <h6>Name: <b id="name"></b></h6>
                    </div>
                    <div class="mb-3">
                      <h6>Email: <b id="email"></b></h6>
                    </div>
                    <div class="mb-3">
                      <h6>Thời gian <b id="month"></b></h6>
                    </div>
                    <div class="mb-3">
                      <h6>Tổng số giờ làm việc <b id="work_hour"></b> giờ</h6>
                    </div>
                    <div class="mb-3">
                      <h6>Lương nhận được: <b id="salary"></b> đồng</h6>
                    </div>
                    <div class="mb-3">
                      <h6>Tình trạng</h6> 
                      <input type="hidden" id="hiddenStatus" name="status" value="0">
                      <select id="statusDropdown" onchange="updateHiddenStatus()">
                        <option value="0">Chưa thanh toán</option>
                        <option value="1">Đã thanh toán</option>
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
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
        });
    });
    function updateHiddenStatus() {
    var selectedStatus = $('#statusDropdown').val();
    $('#hiddenStatus').val(selectedStatus);
}
    </script>
@endsection