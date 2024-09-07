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
        <td><a href="#salaryPayment" class="edit" data-bs-toggle="modal" data-status="{{ $userScan->status }}" data-id="{{ $userScan->user_id }}" data-name="{{ $userScan->name }}" data-month="{{ $userScan->month }}">
          <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
      </a></td>
      </tr>
      <div id="salaryPayment" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="editEmployeeForm">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <input type="hidden" name="editId" id="editId">
                        <span class="text-danger" id="editId-error"></span>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <h6 for="editName" class="form-label"><b>Name: </b></h6>
                        </div>
                        <div class="mb-3">
                          <h6 for="editName" class="form-label"><b>Email: </b></h6>
                        </div>
                        <div class="mb-3">
                          <h6 for="editName" class="form-label"><b>Thời gian: Tháng 
                        </b></h6>
                        </div>
                        <div class="mb-3">
                          <h6 for="editName" class="form-label"><b>Số giờ đã làm việc: </b></h6>
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
    $(document).ready(function(){
        // Khi click vào phần tử a có class là "edit"
        $(".edit").click(function(){
            // Lấy các thuộc tính data từ phần tử a
            var status = $(this).data('status');
            var id = $(this).data('id');
            var name = $(this).data('name');
            var month = $(this).data('month');
            
            // Hiển thị các giá trị trong modal
            $("#editId").val(id);
            $("#editName").text(name);
            $("#editEmail").text(email);
            $("#editTime").text(month);
            $("#editWorkHours").text(workHours);
            
            // Mở modal
            $("#salaryPayment").modal('show');
        });
    });
</script>
@endsection