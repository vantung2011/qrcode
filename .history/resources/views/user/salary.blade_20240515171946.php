@extends('layouts.app')
@section('content')
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
                  <th style="width: 25%;">Thời gian</th>
                  <th style="width: 10%;"></th>
              </tr>
          </thead>
          <tbody>
              <!-- Các dòng của bảng -->
              @foreach ($salaries as $key => $salary)
                  <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $salary->user->name }}</td>
                      <td>{{ $salary->created_at }}</td>
                      <td>
                          @if ($salary->updated_at)
                              {{ $salary->month }}
                          @else
                              N/A
                          @endif
                      </td>
                      <td>{{$salary->salary_amount}}</td>
                  </tr>
              @endforeach
          </tbody>
      </table>
  </div>
</div>
@endsection