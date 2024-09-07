@extends('layouts.app')
@section('content')
<table class="table table-bordered table-striped">
  <thead class="thead-dark">
      <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Status</th>
          <th>Time</th>
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