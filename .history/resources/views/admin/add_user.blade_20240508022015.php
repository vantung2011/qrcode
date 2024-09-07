<div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addEmployeeForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên</label>
                        <input type="text" class="form-control" name="name" placeholder = "" id="name">
                        <span class="text-danger" id="name-error"></span> <!-- Thêm span để hiển thị lỗi -->
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" id="email">
                        <span class="text-danger" id="email-error"></span> <!-- Thêm span để hiển thị lỗi -->
                    </div>
                    <div class="form-group">
                        <label>Tên đăng nhập</label>
                        <input type="text" class="form-control" name="username" id="username">
                        <span class="text-danger" id="username-error"></span> <!-- Thêm span để hiển thị lỗi -->
                    </div>
                    <div class="form-group">
                        <label>Lương</label>
                        <input type="text" class="form-control" name="salary" id="salary">
                        <span class="text-danger" id="salary-error"></span> <!-- Thêm span để hiển thị lỗi -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-toggle="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>
