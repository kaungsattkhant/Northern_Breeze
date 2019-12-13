<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 480px;">
        <div class="modal-content border-0 btr-mount">

            <div class="modal-header modal-title-bg text-center pb-1 border-0 btr-mount">
                <h5 class="text-center mx-auto" id="exampleModalLongTitle">Edit Staff</h5>
            </div>
            <div class="modal-body mx-5 px-0">

                <ul id="editMessage">
                    <li class="col-md-10 alert alert-success" style="height:40px;list-style:none;">
                        <p id="success1"></p>
                    </li>
                </ul>
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

                    <div class="mb-3 row fs-select4 {{$errors->has('role') ? 'has:error':''}}">
                        <label for="#role1" class="w-25" style="padding-left: 16px;">Roles</label>
                        <select name="role" class="selectpicker show-menu-arrow margin-left-mount bd-bottom-mount role_branch_filter" data-width="300px" id="role1">
                            @php
                            $roles=\App\Model\Role::all();
                            @endphp
                            @foreach($roles as $role)
                                <option value="{{$role->id}}" >{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="text-danger">
                                    <strong id="role-error1"></strong>
                                </span>
                    <div class="branch_div mb-3 row fs-select4 {{$errors->has('branch') ? 'has:error':''}}">
                        <label for="#role" class="w-25" style="padding-left: 16px;">Branch</label>
                        <select name="branch" class="selectpicker show-menu-arrow ml-1 bd-bottom-mount" data-width="300px" id="branch1">
{{--                            <option selected disabled>--None--</option>--}}

                            @php
                                $branches=\App\Model\Branch::all();
                            @endphp
                            @foreach($branches as $branch)
                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="text-danger">
                                    <strong id="branch-error1"></strong>
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
