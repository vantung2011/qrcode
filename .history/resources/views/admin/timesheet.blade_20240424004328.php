@extends('layouts.app')
@section('content')
<script>
fetch('http://127.0.0.1:8000/api/timesheet')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
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