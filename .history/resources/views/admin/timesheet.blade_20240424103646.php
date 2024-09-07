@extends('layouts.app')
@section('content')
<table class="table table-bordered table-striped">
  <thead class="thead-dark">
      <tr>
        <th style="width: 25%;">Name</th>
        <th style="width: 25%;">Status</th>
        <th style="width: 25%;">Time</th>
      </tr>
  </thead>
  <tbody>
      @foreach($userScans as $key => $userScan)
      <tr>
        <td>{{ $loop->index+1 }}</td>
          <td>{{ $userScan->user->name }}</td>
          <td>{{ $userScan->scan_type }}</td>
          <<td>
            @if ($userScan->created_at)
                {{ $userScan->created_at->format('d/m/Y H:i') }}
            @else
                N/A
            @endif
        </td>
      </tr>
      @endforeach
  </tbody>
</table>
@endsection