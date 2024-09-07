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
      let listContainer = document.getElementById('listContainer');
      data.forEach(item => {
        let listItem = document.createElement('li');
        listItem.textContent = item;
        listContainer.appendChild(listItem);
      });
    })
    .catch(error => {
      console.error('Fetch error:', error);
    });
</script>
@endsection