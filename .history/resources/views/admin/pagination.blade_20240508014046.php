<form method="GET" class="d-flex" id="searchForm">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" id="search-input">
    <button class="btn btn-outline-success" type="submit" id="btn-search">Search</button>
</form>
<div class="container">
    <div id="success-message" class="alert alert-success text-center" style="display: none;"></div>
    <div class="table-wrapper h-200 shadow-lg mt-8">
        
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Manage <b>Employees</b></h2>
                </div>
                <div class="col-sm-6">
                    <a href="#addEmployeeModal" class="btn btn-success" data-bs-toggle="modal">
                        <i class="material-icons">&#xE147;</i> <span>Thêm nhân viên</span>
                    </a>
                </div>
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th width="10%">ID</th>
                    <th width="35%">Name</th>
                    <th width="35%">Email</th>
                    <th width="20%">Username</th>
                    <th width="10%">Lương/Giờ</th>
                    <th width="10%">Sửa/xóa</th>
                    
                </tr>
            </thead>
            <tbody>
                <!-- Các dòng của bảng -->
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->username }}</td>
                    <td>
                        <a href="#editEmployeeModal" class="edit" data-bs-toggle="modal" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-username="{{ $user->username }}">
                            <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                        </a>
                        <a href="#deleteEmployeeModal" data-id="{{ $user->id }}" class="delete-user" ><i class="material-icons"  title="Delete">&#xE872;</i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>  
        @if(isset($searchError))
        <div class="alert alert-info text-center">
            {{ $searchError }}
        </div>
        @endif
    </div>
    <div class="pagina">
        {{ $users->links() }}
    </div>  
</div>