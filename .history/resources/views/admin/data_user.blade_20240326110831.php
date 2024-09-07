<!DOCTYPE html>
<html>
<head>
  <title>Data User</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <tr>
        <th width="5%">ID</th>
        <th width="38%">Name</th>
        <th width="57%">Email</th>
        <th width="57%">Username</th>
      </tr>
      @foreach($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->username }}</td>
      </tr>
      @endforeach
    </table>
    {{ $users->links() }}
  </div>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<div class="table-responsive">
  <table class="table table-striped table-bordered">
   <tr>
    <th width="5%">ID</th>
    <th width="38%">Name</th>
    <th width="57%">Email</th>
    <th width="57%">Username</th>
   </tr>
   @foreach($users as $user)
   <tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->username }}</td>
   </tr>
   @endforeach
  </table>
  {{ $users->links() }}

 </div>
