@extends('layouts.app')
@section('content')
<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Status</th>
        <th>Time</th>
    </tr>
    @foreach($userScans as $userScan)
    <tr>
        <td>{{ $userScan->user->username}}</td>
        <td>{{ $userScan->user->email}}</td>
        <td>{{ $userScan->scan_type}}</td>
    </tr>
    @endforeach
</table>
@endsection