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
    @foreach($timesheets as $timesheet)
    <tr>
        <td>{{ $userScans->id }}</td>
        <td>{{ $userScans->user->username}}</td>
    </tr>
    @endforeach
</table>
@endsection