@extends('layouts.app')
@section('content')
<script>
fetch('/api/', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({"id": 1})
})
   .then(response => console.log(response.status))
</script>
@endsection