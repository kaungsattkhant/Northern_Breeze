<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
    <div class="modal-dialog " role="document" style="width: 500px;">
        <div class="modal-content ">
            <div class="modal-body mx-3">
                <h5 class="mount-modal-title mb-4" id="exampleModalLongTitle">Add Member</h5>
                <button type="button" class="close x-button-mount" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <form>
                    <div class="mb-3">
                        <label for="#name123" class="w-25">Name</label>
                        <input type="text" id="name" name="name" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input @error('name') is-invalid @enderror ">
                        <span class="text-danger">
                                    <strong id="name-error"></strong>
                                </span>
                    </div>
                    <div class="mb-3">
                        <label for="#c123" class="w-25">Company</label>
                        <input type="text" id="compay" name="company" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input">
                    </div>
                    <div class="mb-3">
                        <label for="#ex123" class="w-50">D.O.B</label>
                        <input type="text" id="dob" name="dob" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input">
                    </div>

                    <div class="mb-3">
                        <label for="#add123" class="w-25">Address</label>
                        <input type="text" id="address" name="address"  class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input">
                    </div>
                    <div class="mb-3">
                        <label for="#ph123" class="w-25">Phone</label>
                        <input type="text" id="phone_number" name="phone_number" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input">
                    <div class="mb-3">
                        <label for="#email" class="w-25">Email</label>
                        <input type="text" id="email" name="email" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input">
                    </div>

                    <div class="mb-3">
                        <label for="#state" class="w-25">State</label>
                        <input type="text" id="state" name="state" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input">
                    </div>
                    <div class="mb-3">
                        <label for="#bod" class="w-25">Exchange Type</label>
                        <select name="exchange_type" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input bg-white text-secondary" id="exchange_type" style="border: 1px solid #ced4da;">
                            <option selected disabled>--None--</option>
                            @foreach($exchange_types as $et)
                                <option value="{{$et->id}}">{{$et->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="#bod" class="w-25">Member Type</label>
                        <select class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input bg-white text-secondary" name="member_type" id="member_type"  style="border: 1px solid #ced4da;">
                            <option selected disabled>--None--</option>
                            @foreach($member_types as $mt)
                                <option value="{{$mt->id}}">{{$mt->name}}</option>
                                @endforeach

                        </select>
                    </div>

                    <div class="m-button">
                        <button type="button" class="btn text-primary " data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn text-primary pl-1 pr-0" id="memberForm">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
