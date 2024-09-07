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
        <td>{{ $userScan->id }}</td>
        <td>{{ $userScan->user->username}}</td>
    </tr>
    @endforeach
</table>
@endsection