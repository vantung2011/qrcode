<div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="editEmployeeForm">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <input type="hidden" name="editId" id="editId">
                    <span class="text-danger" id="editId-error"></span>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editName" name="editName">
                        <span class="text-danger" id="editName-error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="editEmail">
                        <span class="text-danger" id="editEmail-error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="editUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="editUsername" name="editUsername"
                            readonly="readonly">
                        <span class="text-danger" id="editUsername-error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="editSalary" class="form-label">Lương</label>
                        <input type="text" class="form-control" id="editSalary" name="editSalary"
                            readonly="readonly">
                        <span class="text-danger" id="editUsername-error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
