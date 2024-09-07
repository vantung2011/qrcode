@extends('layouts.app')
@section('content')
<form method="GET" class="d-flex" id="searchForm">
  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" id="search-input">
  <label for="start_date">Ngày bắt đầu:</label>
  <input type="date" id="start_date" name="start_date">
  <label for="end_date">Ngày kết thúc:</label>
  <input type="date" id="end_date" name="end_date">
  <button class="btn btn-outline-success" type="submit" id="btn-search">Search</button>
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
 
@endsection