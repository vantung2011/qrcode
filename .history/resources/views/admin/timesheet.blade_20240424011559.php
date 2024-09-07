@extends('layouts.app')
@section('content')
<table class="table table-bordered table-striped">
  <thead class="thead-dark">
      <tr>
        <th style="width: 25%;">Name</th>
        <th style="width: 25%;">Email</th>
        <th style="width: 25%;">Status</th>
        <th style="width: 25%;">Time</th>
      </tr>
  </thead>
  <tbody>
      @foreach($userScans as $userScan)
      <tr>
          <td>{{ $userScan->user->username }}</td>
          <td>{{ $userScan->user->email }}</td>
          <td>{{ $userScan->scan_type }}</td>
          <td>{{ $userScan->created_at }}</td>
      </tr>
      @endforeach
  </tbody>
</table>
@endsection