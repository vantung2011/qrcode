
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <tr>
        <th width="5%">ID</th>
        <th width="38%">Name</th>
        <th width="57%">Email</th>
        <th width="60%">Username</th>
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

  </div>