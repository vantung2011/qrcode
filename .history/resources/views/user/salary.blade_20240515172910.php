@extends('layouts.app')
@section('content')
<div class="container">
  <div class="table-wrapper h-200 shadow-lg mt-8">
      <div class="table-title">
          <div class="row">
              <div class="col-sm-6">
                  <h2><b></b></h2>
              </div>
          </div>
      </div>
      <table class="table table-striped table-bordered table-hover">
          <thead>
              <tr>
                  <th style="width: 10%;">STT</th>
                  <th style="width: 25%;">Thời gian</th>
                  <th style="width: 50%;">Tổng số lương trong tháng</th>
                  <th style="width: 10%;">Số giờ đã làm</th>
              </tr>
          </thead>
          <tbody>
              <!-- Các dòng của bảng -->
              @foreach ($salaries as $key => $salary)
                  <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>
                          @if ($salary->updated_at)
                              {{ $salary->month }}
                          @else
                              N/A
                          @endif
                      </td>
                      <td>{{$salary->work_hours}}</td>
                      <td>{{$salary->salary_amount}}đ</td>
                      <td>
                        @if ($salary->status == 1)
                        <span class="badge text-bg-success">Đã thanh toán</span>
                        @else
                        <span class="badge text-bg-danger">Chưa thanh toán</span>
                        @endif
                      </td>
                  </tr>
              @endforeach
          </tbody>
      </table>
  </div>
</div>
@endsection