@extends('layouts.app')
@section('content')
<table>
    <tr>
        <th></th>
        <th>Task Name</th>
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