<div class="modal fade border-0" id="create" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
    <div class="modal-dialog border-0" role="document" style="width: 460px;">
        <div class="modal-content border-0 btr-mount">
            <div class="modal-header modal-title-bg text-center pb-1 border-0 btr-mount bs-mount">
                <h5 class="text-center mx-auto" id="exampleModalLongTitle">Add Member</h5>
            </div>
            <div class="modal-body mx-5 px-0">

                <form>
                    @csrf
                    <div class="mb-1">
                        <label for="#name123" class="w-25 pt-2 fontsize-mount">Name</label>
                        <input type="text" id="name" name="name" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bd-bottom-mount">
                        <span class="text-danger">
                                    <strong id="name_error"></strong>
                                </span>
                    </div>
                    <div class="mb-2">
                        <label for="#c123" class="w-25 pt-2 fontsize-mount">Company</label>
                        <input type="text" id="company" name="company"  class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bd-bottom-mount">
                        <span class="text-danger">
                                    <strong id="company_error"></strong>
                                </span>
                    </div>
                    <div class="mb-2">
                        <label for="#ex123" class="w-50 fontsize-mount">Exchange Type</label>
                        <select  id="exchange_type" name="exchange_type"  class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bg-white text-secondary bd-bottom-mount fontsize-mount22" >
                            <option selected disabled>--None--</option>
                            @php
                            $exchange_type=\App\Model\ExchangeType::all()
                            @endphp
                            @foreach($exchange_type as $et)
                                <option value={{$et->id}}>{{$et->name}}</option>

                            @endforeach
                        </select>
                        <span class="text-danger">
                                    <strong id="exchange_type_error"></strong>
                                </span>
                    </div>
                    <div class="mb-0">
                        <label for="#ex123" class="w-50 fontsize-mount">Member Type</label>
                        <select class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bg-white text-secondary bd-bottom-mount fontsize-mount22" id="member_type" name="member_type" >
                            <option selected disabled>--None--</option>
                            @php
                            $member_type=\App\Model\MemberType::all();
                            @endphp
                            @foreach($member_type as $mt)
                                <option value="{{$mt->id}}">{{$mt->name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                                    <strong id="member_type_error"></strong>
                                </span>
                    </div>
                    <div class="mb-1">
                        <label for="#bod" class="w-auto mt-3 fontsize-mount">D.O.B</label>
                        <div class="mount-input2 ">
                            <select class="form-control d-inline border-top-0 border-right-0 border-left-0 rounded-0" id="years" name="years"  style="font-size: 14px;width: 33%;">
                            </select>

                            <select class="form-control d-inline border-top-0 border-right-0 border-left-0 rounded-0" id="months" name="months" style="font-size: 14px;width: 32%;">
                            </select>

                            <select class="form-control d-inline border-top-0 border-right-0 border-left-0 rounded-0" id="days" name="days"   style="width: 31%;font-size: 14px;">
                            </select>
                        </div>
                        <span class="text-danger">
                                    <strong id="date_error"></strong>
                                </span>
                    </div>

                    <div class="mb-1">
                        <label for="#ph123" class="w-25 pt-2 fontsize-mount">Phone</label>
                        <input type="text" id="phone_number" name="phone_number"  class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bd-bottom-mount">
                        <span class="text-danger">
                                    <strong id="phone_error"></strong>
                                </span>
                    </div>
                    <div class="mb-1">
                        <label for="#email" class="w-25 pt-2 fontsize-mount">Email</label>
                        <input type="email" id="email" name="email"  class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bd-bottom-mount">
                        <span class="text-danger">
                                    <strong id="email_error"></strong>
                                </span>
                    </div>

{{--                    <div class="mb-1">--}}
{{--                        <label for="#state" class="w-25 pt-2 fontsize-mount">State</label>--}}
{{--                        <input type="text" id="sstat" name="name"  class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bd-bottom-mount">--}}
{{--                    </div>--}}
                    <div class="mb-4">
                        <label for="#add123" class="w-25 fontsize-mount">Address</label>
                        <textarea type="text" id="address" name="address"  class=" border-top-0 border-right-0 border-left-0 rounded-0  d-inline mount-input2 bd-bottom-mount" id="Add123" style="height: 60px;font-size: 15px;"></textarea>
                        <span class="text-danger">
                                    <strong id="address_error"></strong>
                                </span>
                    </div>
                    <div class="m-button pt-3">
                        <button type="button" class="btn btn-nb-mount2 px-3 pt-0 pb-0 mr-4 shadow-0 fontsize-mount22" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-nb-mount2 fontsize-mount22 px-3" id="memberForm">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



