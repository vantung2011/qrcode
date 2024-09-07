@extends('layouts.app')
@section('content')
<table>
    <tr>
        <th>Employee Name</th>
        <th>Project Name</th>
        <th>Task Name</th>
        <th>Time</th>
        <th>Date</th>
    </tr>
    @foreach($userScans as $userScan)
    <tr>
        <td>{{ $userScan->id }}</td>
        <td>{{ $userScans->user->username}}</td>
    </tr>
    @endforeach
</table>
@endsection