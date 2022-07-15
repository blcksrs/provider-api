<!-- Add Modal -->
<div class="modal fade" id="addProviderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 700px !important">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Provider</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="addForm">
            @csrf
            <div class="modal-body">
                <div class="mb-5">
                    <label for="name" class="form-label">Name of Provider</label>
                    <input type="text" class="form-control" id="name" placeholder="Dogs" name="name">
                </div>
                <label for="basic-url" class="form-label">URL</label>
                <div class="input-group mb-5">
                    <span class="input-group-text" id="basic-addon3">https://picsum.photos/id/1/200/300</span>
                    <input type="text" class="form-control" id="url" aria-describedby="basic-addon3" name="url">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="save-prov">Save</button>
            </div>
        </form>
      </div>
    </div>
</div>

<!-- Edit Modal-->
<div class="modal fade" id="editProviderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="editForm">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Provider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="edit_id" id="edit-id"  value="">
                <div class="mb-3">
                    <label for="edit-name" class="form-label">Name of Provider</label>
                    <input type="text" class="form-control" id="edit-name" name="edited_name" value="">
                </div>
                <label for="edit-url" class="form-label">URL</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="edit-url" name="edited_url"  value="" aria-describedby="basic-addon3">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="edit-prov">Save Changes</button>
            </div>
        </form>
      </div>
    </div>
</div>

<!-- Delete  Modal -->
<div class="modal fade" id="deleteProviderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="deleteForm">
            @csrf
            <input type="hidden" name="id" value="" id="deleteId">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Provider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Are you sure you want to delete this?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="delete-prov">Delete</button>
            </div>
        </form>
      </div>
    </div>
</div>