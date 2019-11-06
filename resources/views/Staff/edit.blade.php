<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 480px;">
        <div class="modal-content border-0 btr-mount">
            <div class="modal-header modal-title-bg text-center pb-1 border-0 btr-mount">
                <h5 class="text-center mx-auto" id="exampleModalLongTitle">Edit Staff</h5>
            </div>
            <div class="modal-body mx-5 px-0">

                <button type="button" class="close x-button-mount" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="mb-1 alert alert-success"   id="editMessage">
                    <strong id="success1"></strong>
                </div>
                <form>
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3 {{$errors->has('name') ? 'has:error':''}}">
                        <label for="#name123" class="w-25">Name</label>
                        <input type="text" id="name1" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input" >

                    </div>
                    <span class="text-danger">
                                    <strong id="name_error1"></strong>
                                </span>
                    <div class="mb-3 {{$errors->has('email') ? 'has:error':''}}">
                        <label for="#pass123" class="w-25">Email</label>
                        <input type="text" id="email1" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input">

                    </div>
                    <span class="text-danger">
                                    <strong id="email-error1"></strong>
                                </span>
                    <div class="mb-3 {{$errors->has('role') ? 'has:error':''}}">
                        <label for="#role" class="w-25">Roles</label>
                        <select name="role" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input bg-white text-secondary" id="role1" style="border: 1px solid #ced4da;">
                            <option selected disabled>--None--</option>
                            @php
                            $roles=\App\Model\Role::all();
                            @endphp
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="text-danger">
                                    <strong id="role-error1"></strong>
                                </span>
                    <div class="m-button pt-3">
                        <button type="button" class="btn btn-nb-mount2 px-3 pt-0 pb-0 mr-4 shadow-0 fontsize-mount22" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-nb-mount2 fontsize-mount22 px-3" id="submitForm1">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
