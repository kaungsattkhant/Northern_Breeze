

<div class="modal fade border-0" id="daily_detail" tabindex="-1" role="dialog" aria-labelledby="detail" aria-hidden="true">
    <div class="modal-dialog modal-lg border-0" role="document" style="width: 600px;">
        <div class="modal-content border-0 btr-mount">
            <div class="modal-header modal-title-bg text-center pb-1 border-0 btr-mount bs-mount">
                <h5 class="text-center mx-auto" id="exampleModalLongTitle">Stock Inventory Detail</h5>
                <button type="button" class="close x-button-mount pr-2 mr-1 text-white" data-dismiss="modal" aria-label="Close" style="opacity: 1">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-5 px-3">
                <div class="pt-5">


                    <table class="table bg-white box-shadow-mount rounded-table-mount "  id="myTable">
                        <thead>
                        <tr id="daily_row">

                            <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6" >Date</th>

                            <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6" >Selling </th>
                            <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Buying</th>

                            {{--                            <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Buying Value</th>--}}
{{--                            <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Selling Value</th>--}}

                        </tr>
                        </thead>
                        <tbody id="dailycurrency_detail">

{{--                        @foreach($groups as $group)--}}
{{--                            <tr>--}}
{{--                                <td scope="row" class="table-row-m fontsize-mount2">{{$group->currency->name}}</td>--}}

{{--                                <td scope="row" class="table-row-m fontsize-mount2">{{$group->name}}</td>--}}
{{--                                <td class="table-row-m fontsize-mount2">--}}
{{--                                    @foreach($group->notes as $note)--}}
{{--                                        {{$note->name}}--}}
{{--                                    @endforeach--}}
{{--                                </td>--}}
{{--                                <td class="table-row-m text-info">--}}
{{--                                    {{$group->lastest_buy_value}}--}}
{{--                                </td>--}}
{{--                                <td class="table-row-m text-info">--}}
{{--                                    {{$group->lastest_sell_value}}--}}
{{--                                </td>--}}
{{--                                <td class="table-row-m "><a href="#" class="text-a-mount" data-toggle="modal" data-target="#detail">Detail</a></td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
                        </tbody>
                    </table>
                </div>

{{--                <form>--}}
{{--                    <div class="my-2">--}}
{{--                        --}}{{--                        <label for="branch" class="w-25 fontsize-mount">Branch</label>--}}
{{--                        <p class="d-inline fontsize-mount text-nb-mount">Branch</p>--}}
{{--                        <p id="branch" class="mount-input2 p-0 fontsize-mount text-nb-mount">: Branch1</p>--}}
{{--                    </div>--}}
{{--                    <div class="my-3">--}}
{{--                        <p class="d-inline fontsize-mount text-nb-mount">Date : Time</p>--}}
{{--                        <p id="branch" class="mount-input2 p-0 fontsize-mount text-nb-mount">: 21.10.2019 - 11:22 AM</p>--}}
{{--                    </div>--}}
{{--                    <div class="my-3">--}}
{{--                        <p class="d-inline fontsize-mount text-nb-mount">Currency</p>--}}
{{--                        <p id="branch" class="mount-input2 p-0 fontsize-mount text-nb-mount">: MMK</p>--}}
{{--                    </div>--}}
{{--                    <div class="my-3">--}}
{{--                        <p class="d-inline fontsize-mount text-nb-mount">1000</p>--}}
{{--                        <p id="branch" class="mount-input2 p-0 fontsize-mount text-nb-mount">: 50</p>--}}
{{--                    </div>--}}
{{--                    <div class="my-3">--}}
{{--                        <p class="d-inline fontsize-mount text-nb-mount">500</p>--}}
{{--                        <p id="branch" class="mount-input2 p-0 fontsize-mount text-nb-mount">: 50</p>--}}
{{--                    </div>--}}

{{--                    <div class="my-3">--}}
{{--                        <p class="d-inline fontsize-mount text-nb-mount">200</p>--}}
{{--                        <p id="branch" class="mount-input2 p-0 fontsize-mount text-nb-mount">: 50</p>--}}
{{--                    </div>--}}
{{--                    <div class="my-3">--}}
{{--                        <p class="d-inline fontsize-mount text-nb-mount">100</p>--}}
{{--                        <p id="branch" class="mount-input2 p-0 fontsize-mount text-nb-mount">: 50</p>--}}
{{--                    </div>--}}
{{--                    <hr>--}}
{{--                    <div class="my-3">--}}
{{--                        <p class="d-inline fontsize-mount6 font-weight-bold text-nb-mount">Total </p>--}}
{{--                        <p id="branch" class="mount-input2 p-0 fontsize-mount6 text-nb-mount">: 173859375 Kyats</p>--}}
{{--                    </div>--}}
{{--                  --}}
{{--                </form>--}}
            </div>


        </div>
    </div>
</div>




