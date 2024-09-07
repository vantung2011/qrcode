@extends('layouts.app')
@section('content')
<script>
    $(document).ready(function() {
        $('#timesheet').DataTable();
    });
</script>
@endsection