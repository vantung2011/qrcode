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
        <td><a href="#salaryPayment" class="edit" data-bs-toggle="modal" data-status="{{ $userScan->status }}" data-id="{{ $userScan->id}}" data-name="{{ $userScan->name }}" data-month="{{ $userScan->month }}" data-work_hour="{{$userScan->work_hours}}" data-email="{{ $userScan->email }}" data-salary="{{ $userScan->salary_amount }}">
          <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
      </a></td>
      </tr>
   
          </tbody>
        </table>
  </div> 
</div>
<div>

@endsection