{{--<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">--}}
{{--    <div class="modal-dialog " role="document" style="width: 470px;">--}}
{{--        <div class="modal-content border-0 btr-mount">--}}
{{--            <div class="modal-header modal-title-bg text-center pb-1 border-0 btr-mount">--}}
{{--                <h5 class="text-center mx-auto" id="exampleModalLongTitle">Edit Member</h5>--}}
{{--            </div>--}}
{{--            <div class="modal-body mx-5 px-0">--}}
{{--                <form>--}}
{{--                    <div class="mb-1">--}}
{{--                        <label for="#name123" class="w-25 pt-2 fontsize-mount">Name</label>--}}
{{--                        <input type="text" id="name123" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bd-bottom-mount">--}}
{{--                    </div>--}}
{{--                    <div class="mb-2">--}}
{{--                        <label for="#c123" class="w-25 pt-2 fontsize-mount">Company</label>--}}
{{--                        <input type="text" id="c123" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bd-bottom-mount">--}}
{{--                    </div>--}}
{{--                    <div class="mb-2">--}}
{{--                        <label for="#ex123" class="w-50 fontsize-mount">Exchange Type</label>--}}
{{--                        <select class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bg-white text-secondary bd-bottom-mount fontsize-mount22" id="bod">--}}
{{--                            <option selected disabled>--None--</option>--}}
{{--                            <option>Personal</option>--}}
{{--                            <option>Business</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="mb-0">--}}
{{--                        <label for="#ex123" class="w-50 fontsize-mount">Member Type</label>--}}
{{--                        <select class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bg-white text-secondary bd-bottom-mount fontsize-mount22" id="bod">--}}
{{--                            <option selected disabled>--None--</option>--}}
{{--                            <option>1</option>--}}
{{--                            <option>2</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="mb-1">--}}
{{--                        <label for="#bod" class="w-auto mt-3 fontsize-mount">B.O.D</label>--}}
{{--                        <div class="mount-input2 ">--}}
{{--                            <select class="form-control d-inline border-top-0 border-right-0 border-left-0 rounded-0" id="Eyears" style="font-size: 14px;width: 33%;">--}}
{{--                            </select>--}}

{{--                            <select class="form-control d-inline border-top-0 border-right-0 border-left-0 rounded-0" id="Emonths" style="font-size: 14px;width: 32%;">--}}
{{--                            </select>--}}

{{--                            <select class="form-control d-inline border-top-0 border-right-0 border-left-0 rounded-0" id="Edays"  style="width: 31%;font-size: 14px;">--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="mb-1">--}}
{{--                        <label for="#ph123" class="w-25 pt-2 fontsize-mount">Phone</label>--}}
{{--                        <input type="text" id="ph123" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bd-bottom-mount">--}}
{{--                    </div>--}}
{{--                    <div class="mb-1">--}}
{{--                        <label for="#email" class="w-25 pt-2 fontsize-mount">Email</label>--}}
{{--                        <input type="email" id="email" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bd-bottom-mount">--}}
{{--                    </div>--}}

{{--                    <div class="mb-1">--}}
{{--                        <label for="#state" class="w-25 pt-2 fontsize-mount">State</label>--}}
{{--                        <input type="text" id="state" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bd-bottom-mount">--}}
{{--                    </div>--}}
{{--                    <div class="mb-4">--}}
{{--                        <label for="#add123" class="w-25 fontsize-mount">Address</label>--}}
{{--                        <textarea type="text" class=" border-top-0 border-right-0 border-left-0 rounded-0  d-inline mount-input2 bd-bottom-mount" id="Add123" style="height: 60px;font-size: 15px;"></textarea>--}}
{{--                    </div>--}}
{{--                    <div class="m-button pt-3">--}}
{{--                        <button type="button" class="btn btn-nb-mount2 px-3 pt-0 pb-0 mr-4 shadow-0 fontsize-mount22" data-dismiss="modal">Cancel</button>--}}
{{--                        <button type="button" class="btn btn-nb-mount2 fontsize-mount22 px-3">Save</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="modal fade border-0" id="edit" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
    <div class="modal-dialog border-0" role="document" style="width: 460px;">
        <div class="modal-content border-0 btr-mount">
            <div class="modal-header modal-title-bg text-center pb-1 border-0 btr-mount bs-mount">
                <h5 class="text-center mx-auto" id="exampleModalLongTitle">Edit Member</h5>
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
                    <div class="mb-1">
                        <label for="#name123" class="w-25 pt-2 fontsize-mount">Name</label>
                        <input type="text" id="name1" name="name" class="pl-2 border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bd-bottom-mount">

                    </div>
                    <span class="text-danger">
                                    <strong id="name_error1"></strong>
                                </span>
                    <div class="mb-2">
                        <label for="#c123" class="w-25 pt-2 fontsize-mount">Company</label>
                        <input type="text" id="company1" name="company"  class="pl-2 border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bd-bottom-mount">

                    </div>
                    <span class="text-danger">
                                    <strong id="company_error1"></strong>
                                </span>
                    <div class="mb-2 row fs-select4">
                        <label for="exchange_type" class="fontsize-mount d-inline col-4">Exchange Type</label>
                        <select  id="exchange_type1" name="exchange_type"  class=" selectpicker d-inline bd-bottom-mount ml-3" data-width="231px">
                        <option selected disabled>--None--</option>
                            @php
                                $exchange_type=\App\Model\ExchangeType::all()
                            @endphp
                            @foreach($exchange_type as $et)
                                <option value={{$et->id}}>{{$et->name}}</option>

                            @endforeach
                        </select>

                    </div>
                    <span class="text-danger">
                                    <strong id="exchange_type_error1"></strong>
                                </span>
                    <div class="mb-0 row fs-select4">
                        <label for="#member_type" class="col-4 col-4 fontsize-mount">Member Type</label>
                        <select  class=" selectpicker d-inline bd-bottom-mount ml-3" data-width="231px" id="member_type1" name="member_type" >
                        <option selected disabled>--None--</option>
                            @php
                                $member_type=\App\Model\MemberType::all();
                            @endphp
                            @foreach($member_type as $mt)
                                <option value="{{$mt->id}}">{{$mt->name}}</option>

                            @endforeach
                        </select>

                    </div>
                    <span class="text-danger">
                                    <strong id="member_type_error1"></strong>
                                </span>
                    <div class="mb-1">
                        <label class="w-25 pt-2 fontsize-mount">Points</label>
                        <input type="number" id="points1" name="points" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bd-bottom-mount">

                    </div>
                    <span class="text-danger">
                            <strong id="points1_error"></strong>
                        </span>
                    <div class="mb-2">
                        <label for="#bod" class="w-auto mt-3 fontsize-mount">D.O.B</label>
                        <div class="mount-input2 pt-2">
                            <select class="form-control d-inline border-top-0 border-right-0 border-left-0 rounded-0" id="Eyears" name="years"  style="font-size: 14px;width: 33%;">
                            </select>

                            <select class="form-control d-inline border-top-0 border-right-0 border-left-0 rounded-0" id="Emonths" name="years" style="font-size: 14px;width: 32%;">
                            </select>

                            <select class="form-control d-inline border-top-0 border-right-0 border-left-0 rounded-0" id="Edays" name="years"   style="width: 31%;font-size: 14px;">
                            </select>
                        </div>

                    </div>
                    <span class="text-danger">
                                    <strong id="date_error1"></strong>
                                </span>
                    <div class="mb-1">
                        <label for="#phone_number1" class="w-25 pt-2 fontsize-mount">Phone</label>
                        <input type="text" id="phone_number1" name="phone_number"  class="pl-2 border-top-0 border-right-0 border-left-0 pt-2 rounded-0 mount-input2 bd-bottom-mount">

                    </div>
                    <span class="text-danger">
                                    <strong id="phone_number-error1"></strong>
                                </span>
                    <div class="mb-1">
                        <label for="#email" class="w-25 pt-2 fontsize-mount">Email</label>
                        <input type="email" id="email1" name="email"  class="pl-2 border-top-0 border-right-0 border-left-0 pt-2 rounded-0 mount-input2 bd-bottom-mount">

                    </div>
                    <span class="text-danger">
                                    <strong id="email_error1"></strong>
                                </span>
                    {{--                    <div class="mb-1">--}}
                    {{--                        <label for="#state" class="w-25 pt-2 fontsize-mount">State</label>--}}
                    {{--                        <input type="text" id="sstat" name="name"  class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input2 bd-bottom-mount">--}}
                    {{--                    </div>--}}
                    <div class="mb-4">
                        <label for="#add123" class="w-25 fontsize-mount">Address</label>
                        <textarea type="text" id="address1" name="address"  class="pl-2  border-top-0 border-right-0 border-left-0 rounded-0  d-inline mount-input2 bd-bottom-mount" id="Add123" style="height: 60px;font-size: 15px;"></textarea>

                    </div>
                    <span class="text-danger">
                                    <strong id="address_error1"></strong>
                                </span>
                    <div class="m-button pt-3">
                        <button type="button" class="btn btn-nb-mount2 px-3 pt-0 pb-0 mr-4 shadow-0 fontsize-mount22" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-nb-mount2 fontsize-mount22 px-3" id="memberForm1">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>




