@extends('layouts.app')
@section('content')
<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Check-in</th>
        <th>Check-out</th>
    </tr>
    @foreach($userScans as $userScan)
    <tr>
        <td>{{ $userScan->user->username}}</td>
        <td>{{ $userScan->user->email}}</td>
        <td>{{ $userScan->check-in}}</td>
    </tr>
    @endforeach
</table>
@endsection