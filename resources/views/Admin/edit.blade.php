<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 450px;">
        <div class="modal-content ">
            <div class="modal-body mx-3">
                <h5 class="mount-modal-title text-center mb-4" id="exampleModalLongTitle">Edit Admin</h5>
                <button type="button" class="close x-button-mount" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <form>
                    <div class="mb-3">
                        <label for="#name123" class="w-25">Username</label>
                        <input type="text" id="name123" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input">
                    </div>
                    <div class="mb-3">
                        <label for="#pass123" class="w-25">Password</label>
                        <input type="password" id="pass123" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input">
                    </div>

                    <div class="mb-3">
                        <label for="#role" class="w-25">Roles</label>
                        <select class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input bg-white text-secondary" id="role" style="border: 1px solid #ced4da;">
                            <option selected disabled>--None--</option>
                            <option>a</option>
                            <option>b</option>
                            <option>c</option>
                        </select>
                    </div>
                    <div class="m-button">
                        <button type="button" class="btn text-primary " data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn text-primary pl-1 pr-0">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
