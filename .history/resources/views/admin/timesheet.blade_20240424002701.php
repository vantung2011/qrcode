@extends('layouts.app')
@section('content')
<script>
async function logMovies() {
  const response = await fetch("/timesheet");
  const movies = await response.json();
  console.log(movies);
}
logMovies();
</script>
@endsection