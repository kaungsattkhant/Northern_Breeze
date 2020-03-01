<div class="modal fade border-0" id="create" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
    <div class="modal-dialog border-0" role="document" style="width: 460px;">
        <div class="modal-content border-0 btr-mount">
            <div class="modal-header modal-title-bg text-center pb-1 border-0 btr-mount bs-mount">
                <h5 class="text-center mx-auto" id="exampleModalLongTitle">Add Member</h5>

                <button type="button" class="close" data-dismiss="modal">&times;</button>            </div>
            <div class="modal-body mx-5 px-0">
                <ul id="createMessage">
                    <li class="col-md-10 alert alert-success" style="height:40px;list-style:none;">
                        <p id="success">Created Successfully</p>
                    </li>
                </ul>

                <form>
                    @csrf
                    <div class="mb-1">
                        <label for="#name123" class="w-25 pt-2 fontsize-mount">Name</label>
                        <input type="text" id="name" name="name" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bd-bottom-mount">

                    </div>
                    <span class="text-danger" id="name_error">
                        </span>
                    <div class="mb-1">
                        <label for="#name123" class="w-25 pt-2 fontsize-mount">Name</label>
                        <input type="text" id="name" name="name" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bd-bottom-mount">
                    </div>
                    <div class="mb-2">
                        <label for="#c123" class="w-25 pt-2 fontsize-mount">Company</label>
                        <input type="text" id="company" name="company"  class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bd-bottom-mount">

                    </div>
                    <span class="text-danger" id="company_error">
                                </span>
                    <div class="mb-2 row fs-select4">
                        <label for="exchange_type" class="fontsize-mount d-inline col-4">Exchange Type</label>
                        <select  id="exchange_type" name="exchange_type"  class=" selectpicker d-inline bd-bottom-mount ml-3" data-width="231px">
                            <option selected disabled>--None--</option>
                            @php
                            $exchange_type=\App\Model\ExchangeType::all()
                            @endphp
                            @foreach($exchange_type as $et)
                                <option value={{$et->id}}>{{$et->name}}</option>

                            @endforeach
                        </select>


                    </div>
                    <span class="text-danger" id="exchange_type_error">
{{--                                    <strong id="exchange_type_error"></strong>--}}
                                </span>
                    <div class="mb-0 row fs-select4">
                        <label for="#member_type" class="col-4 col-4 fontsize-mount">Member Type</label>
                        <select  class=" member_type_select selectpicker d-inline bd-bottom-mount ml-3" data-width="231px member_type" id="member_type" name="member_type" >
                            <option selected disabled>--None--</option>
                            @php
                            $member_type=\App\Model\MemberType::all();
                            @endphp
                            @foreach($member_type as $mt)
                                <option value="{{$mt->id}}">{{$mt->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="text-danger"  id="member_type_error">
                                </span>
                    <div class="mb-1">
                        <label class="w-25 pt-2 fontsize-mount">Points</label>
                        <input  type="number" id="points" name="points" class="amount_of_point border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bd-bottom-mount" min="0">

                    </div>
                    <span class="text-danger" id="points_error">
                        </span>
                    <div class="mb-2">
                        <label for="#bod" class="w-auto mt-3 fontsize-mount">D.O.B</label>
                        <div class="mount-input2 pt-2">
                            <select class="form-control d-inline border-top-0 border-right-0 border-left-0 rounded-0" id="years" name="years"  style="font-size: 14px;width: 33%;">
                            </select>

                            <select class="form-control d-inline border-top-0 border-right-0 border-left-0 rounded-0" id="months" name="months" style="font-size: 14px;width: 32%;">
                            </select>

                            <select class="form-control d-inline border-top-0 border-right-0 border-left-0 rounded-0" id="days" name="days"   style="width: 31%;font-size: 14px;">
                            </select>
                        </div>

                    </div>
                    <span class="text-danger" id="date_error">
{{--                                    <strong ></strong>--}}
                                </span>
                    <div class="mb-1">
                        <label for="#phone_number" class="w-25 pt-2 fontsize-mount">Phone</label>
                        <input type="text" id="phone_number" name="phone_number"  class="border-top-0 border-right-0 border-left-0 pt-2 rounded-0 mount-input2 bd-bottom-mount">

                    </div>
                    <span class="text-danger" id="phone_number_error">
{{--                                    <strong id="phone_number_error"></strong>--}}
                                </span>
                    <div class="mb-1">
                        <label for="#email" class="w-25 pt-2 fontsize-mount">Email</label>
                        <input type="email" id="email" name="email"  class="border-top-0 border-right-0 border-left-0 pt-2 rounded-0 mount-input2 bd-bottom-mount">

                    </div>
                    <span class="text-danger" id="email_error">
{{--                                    <strong id="email_error"></strong>--}}
                                </span>
{{--                    <div class="mb-1">--}}
{{--                        <label for="#state" class="w-25 pt-2 fontsize-mount">State</label>--}}
{{--                        <input type="text" id="sstat" name="name"  class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bd-bottom-mount">--}}
{{--                    </div>--}}
                    <div class="mb-4">
                        <label for="#add123" class="w-25 fontsize-mount">Address</label>
                        <textarea type="text" id="address" name="address"  class=" border-top-0 border-right-0 border-left-0 rounded-0  d-inline mount-input2 bd-bottom-mount" id="Add123" style="height: 60px;font-size: 15px;"></textarea>

                    </div>
                    <span class="text-danger"  id="address_error">
                                </span>
                    <div class="m-button pt-3">
                        <button type="button" class="btn btn-nb-mount2 px-3 pt-0 pb-0 mr-4 shadow-0 fontsize-mount22" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-nb-mount2 fontsize-mount22 px-3" id="memberForm">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



