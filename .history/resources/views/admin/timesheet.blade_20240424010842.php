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
        <td>{{ $timesheet->task->name }}</td>
        <td>{{ $timesheet->time }}</td>
        <td>{{ $timesheet->date }}</td>
    </tr>
    @endforeach
</table>
@endsection