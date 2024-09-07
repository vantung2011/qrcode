@extends('layouts.app')
@section('content')
<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Time</th>
        <th>Date</th>
    </tr>
    @foreach($userScans as $userScan)
    <tr>
        <td>{{ $userScan->user->username}}</td>
        <td>{{ $userScan->user->email}}</td>
    </tr>
    @endforeach
</table>
@endsection