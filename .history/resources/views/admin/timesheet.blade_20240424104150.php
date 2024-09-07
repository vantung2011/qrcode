@extends('layouts.app')
@section('content')
<table class="table table-bordered table-striped">
  <thead class="thead-dark">
      <tr>
        <th style="width: 25%;">STT</th>
        <th style="width: 25%;">Name</th>
        <th style="width: 25%;">CheckIn</th>
        <th style="width: 25%;">CheckOut</th>
        <th style="width: 25%;">Time</th>
      </tr>
  </thead>
  <tbody>
      @foreach($userScans as $key => $userScan)
      <tr>
        <td>{{ $loop->index+1 }}</td>
        <td>{{ $userScan->user->name }}</td>
        <td>{{ $userScan->user->check }}</td>
        <td>{{ $userScan->user->name }}</td>
        <td>{{ $userScan->check_in}}</td>
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