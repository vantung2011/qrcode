@extends('layouts.app')
@section('content')
<div class="container">
  <div class="table-wrapper h-200 shadow-lg mt-8">
      <div class="table-title">
          <div class="row">
              <div class="col-sm-6">
                  <h2><b>TimeSheet</b></h2>
              </div>
          </div>
      </div>
      <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th style="width: 10%;">STT</th>
              <th style="width: 25%;">Name</th>
              <th style="width: 25%;">Tổng thời gian làm</th>
            </tr>
          </thead>
          <tbody>
              <!-- Các dòng của bảng -->
              @foreach($userScans as $key => $userScan)
      <tr>
        <td>{{ $loop->index+1 }}</td>
        <td>{{ $userScan->user->name }}</td>
          <td>
            @if ($userScan->updated_at !==null && $userScan->created_at)
            <td>{{$duration = $userScan->created_at->diff($userScan->check_out)->format('%h giờ %i phút')}}</td>
            @else
                N/A
            @endif
        </td>
        <td>{{$userScan->created_at->format('d/m')}}</td>
      </tr>
      @endforeach
          </tbody>
        </table>
  </div> 
</div>
@endsection