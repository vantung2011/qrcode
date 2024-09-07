@extends('layouts.app')
@section('content')
<ul id="listContainer"></ul>
<script>
fetch('http://127.0.0.1:8000/api/timesheet')
    .then(response => {
        return response.json();
    })
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('Fetch error:', error);
    });
</script>
@endsection