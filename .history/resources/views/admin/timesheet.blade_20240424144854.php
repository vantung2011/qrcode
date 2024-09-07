@extends('layouts.app')
@section('content')
<form method="GET" class="d-flex" id="searchForm">
  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" id="search-input">
  <div class="input-group">
      <label>
          <span class="input-group-text">Ngày bắt đầu:</span>
      </label>
      <input type="date" id="start_date" name="start_date" class="form-control">
  </div>
  <div class="input-group">
    <label>
      <span class="input-group-text">Ngày kết thúc:</span>
  </label>
      <input type="date" id="end_date" name="end_date" class="form-control">
  </div>
  <button class="btn btn-outline-success ml-2" type="submit" id="btn-search">Search</button>
</form>
<table class="table table-bordered table-striped">
  <thead class="thead-dark">
      <tr>
        <th style="width: 10%;">STT</th>
        <th style="width: 25%;">Name</th>
        <th style="width: 25%;">CheckIn</th>
        <th style="width: 25%;">CheckOut</th>
      </tr>
  </thead>
  <tbody>
      @foreach($userScans as $key => $userScan)
      <tr>
        <td>{{ $loop->index+1 }}</td>
        <td>{{ $userScan->user->name }}</td>
        <td>{{ $userScan->created_at}}</td>
          <td>
            @if ($userScan->updated_at)
                {{ $userScan->check_out}}
            @else
                N/A
            @endif
        </td>
      </tr>
      @endforeach
  </tbody>
</table>

<div class="container">
  <div id="success-message" class="alert alert-success text-center" style="display: none;"></div>
  <div class="table-wrapper h-200 shadow-lg mt-8">
      
      <div class="table-title">
          <div class="row">
              <div class="col-sm-6">
                  <h2>Manage <b>Employees</b></h2>
              </div>
              <div class="col-sm-6">
                  <a href="#addEmployeeModal" class="btn btn-success" data-bs-toggle="modal">
                      <i class="material-icons">&#xE147;</i> <span>Thêm nhân viên</span>
                  </a>
              </div>
          </div>
      </div>
      <table class="table table-striped table-bordered table-hover">
          <thead>
              <tr>
                  <th width="10%">ID</th>
                  <th width="35%">Name</th>
                  <th width="35%">Email</th>
                  <th width="20%">Username</th>
                  <th width="10%">Sửa/xóa</th>
              </tr>
          </thead>
          <tbody>
              <!-- Các dòng của bảng -->
              @foreach($userScans as $key => $userScan)
      <tr>
        <td>{{ $loop->index+1 }}</td>
        <td>{{ $userScan->user->name }}</td>
        <td>{{ $userScan->created_at}}</td>
          <td>
            @if ($userScan->updated_at)
                {{ $userScan->check_out}}
            @else
                N/A
            @endif
        </td>
      </tr>
      @endforeach
          </tbody>
      </table>  
      @if(isset($searchError))
      <div class="alert alert-info text-center">
          {{ $searchError }}
      </div>
      @endif
  </div>
  <div class="pagina">
      {{ $users->links() }}
  </div>  
</div>
@endsection