    <div class="modal fade" id="branch_create" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="width: 490px;">
            <div class="modal-content border-0 btr-mount">
                <div class="modal-header modal-title-bg text-center pb-1 border-0 btr-mount">
                    <h5 class="text-center mx-auto" id="exampleModalLongTitle">Add New Branch</h5>
                </div>
                <div class="modal-body mx-5 px-0">

                    <ul id="createMessage">
                        <li class="col-md-10 alert alert-success" style="height:40px;list-style:none;">
                            <p id="success"></p>
                        </li>
                    </ul>
                    <form>
                        @csrf
                        <div class="mb-3 ">
                            <label for="#name123" class="w-25">Name</label>
                            <input type="text" id="name" name="name" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input">
                        </div>
                        <span class="text-danger" id="name_error">
                                </span>
                        <div class="mb-3 ">
                            <label for="#role" class="w-25">Phone_Number</label>
                            <input type="text" id="phone_number"  name="phone_number" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input">
                        </div>
                        <span class="text-danger" id="phone_number_error">
                                </span>
                        <div class="mb-0 row fs-select4">
                            <label  class="col-4 col-4 fontsize-mount">Branch_Type</label>
                            <select  class=" selectpicker d-inline bd-bottom-mount ml-3" data-width="231px branch_type" name="branch_type" id="branch_type" >
                                <option selected disabled>--None--</option>
                                @php
                                    $branch_type=\App\Model\BranchType::all();
                                @endphp
                                @foreach($branch_type as $bt)
                                    <option value="{{$bt->id}}">{{$bt->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="text-danger" id="branch_type_error">
                                </span>
                        <div class="mb-3 ">
                            <label  class="w-25">Address</label>
                            <textarea id="address" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input" name="address">
                            </textarea>
                        </div>
                        <span class="text-danger" id="address_error">
                                </span>
                            <div class="m-button pt-3">
                            <button type="button" class="btn btn-nb-mount2 px-3 pt-0 pb-0 mr-4 shadow-0 fontsize-mount22" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-nb-mount2 fontsize-mount22 px-3" id="branchForm">Save</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

