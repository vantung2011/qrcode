@extends('layouts.app')
@section('content')
<script>
async function logMovies() {
  const response = await fetch("http://127.0.0.1:8000/api/timesheett");
  const movies = await response.json();
  console.log(movies);
}
</script>
@endsection