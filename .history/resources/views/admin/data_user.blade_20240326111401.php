
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <tr>
        <th >ID</th>
        <th >Name</th>
        <th>Email</th>
        <th>Username</th>
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