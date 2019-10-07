<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 450px;">
        <div class="modal-content ">
            <div class="modal-body mx-3">
                <h5 class="mount-modal-title text-center mb-4" id="exampleModalLongTitle">Add New Admin</h5>
                <button type="button" class="close x-button-mount" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <form>
                    <div class="mb-3 {{$errors->has('name') ? 'has:error':''}}">
                        <label for="#name123" class="w-25">Username</label>
                        <input type="text" id="name" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input">
                        <span class="text-danger">
                                    <strong id="name-error"></strong>
                                </span>
                    </div>
                    <div class="mb-3 {{$errors->has('password') ? 'has:error':''}}">
                        <label for="#pass123" class="w-25">Password</label>
                        <input type="password" id="password" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input">
                        <span class="text-danger">
                                    <strong id="password-error"></strong>
                                </span>
                    </div>

                    <div class="mb-3 {{$errors->has('password_confirmation') ? 'has:error':''}}">
                        <label for="#pass123" class="w-25">Password</label>
                        <input type="password" id="password" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input">
                        <span class="text-danger">
                                    <strong id="password_confirmaiton-error"></strong>
                                </span>
                    </div>

                    <div class="mb-3">
                        <label for="#role" class="w-25">Roles</label>
                        <select name="role" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input bg-white text-secondary" id="role" style="border: 1px solid #ced4da;">
                            <option selected disabled>--None--</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div> <span class="text-danger">
                                    <strong id="role-error"></strong>
                                </span>

                    <div class="m-button">
                        <button type="button" class="btn text-primary " data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn text-primary pl-1 pr-0" id="submitForm">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
