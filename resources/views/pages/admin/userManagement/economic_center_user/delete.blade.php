<!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Delete System User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the user? <br><br>
                    <strong id="userName"></strong> (Role: <strong id="userRole"></strong>)
                </p>
                <!-- Add the form here -->
                <form id="deleteUserForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="user_id" value="">
                    <input type="hidden" name="user_roles" value="">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="confirmDeleteButton" type="button" class="btn btn-danger" onclick="deleteUser()">Delete</button>
            </div>
        </div>
    </div>
</div>
