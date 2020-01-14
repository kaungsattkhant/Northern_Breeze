@extends('Layouts.master')
@section('content')

        <div class="container-nb-mount">
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="col-md-10 alert alert-danger" style="height:40px;margin:0;list-style:none;">
                            {{ $error }}</li>
                    @endforeach
                </ul>
            @endif
{{--                <form id="stockForm">--}}
                    <form action="{{url('stock/store')}}" method="post" id="stock_create_form" >
                @csrf
            <div class="d-flex justify-content-between top-box-mount shadow-sm">
                                <div class="my-auto">
                                    <p style="margin-left: 20px"><b>Total values:</b><i> {{$branch_total_value}}MMKs</i></p>
                                </div>
                <button type="submit" class="btn btn-nb-mount-save fontsize-mount px-4 stock_create" >Add</button>
            </div>
                        <div class="row">
                            <div class="col">
                                <select class="selectpicker  mt-4" name="currency" data-style="btn-white" data-width="auto" data-live-search="true" id="stock_currency_filter">
                                    <option  disabled selected>Currency Value</option>
                                    @php
                                        $currencies=\App\Model\Currency::all();
                                    @endphp
                                    @foreach($currencies as $currency)
                                        <option value="{{$currency->id}}"  selected>{{$currency->name}}</option>
                                    @endforeach
                                </select>
                            </div>
{{--                            <div class="col" id="branch">--}}


{{--                                <select class="selectpicker mt-4" name="branch" data-style="btn-white" data-width="auto" id="to_branch">--}}
{{--                                    <option  disabled selected>Choose Branch</option>--}}
{{--                                    @php--}}
{{--                                        $branches=\App\Model\Branch::all();--}}

{{--                                    @endphp--}}
{{--                                    @foreach($branches as $branch)--}}
{{--                                        <option value="{{$branch->id}}" @if(\Illuminate\Support\Facades\Auth::user()->branch_id==$branch->id) disabled  @endif >{{$branch->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <button type="submit" id="stock_filter" class="btn btn-danger">Filter</button>--}}
                        </div>
            <div class="row" id="stock_table_filter">
{{--                <button type="button" class="btn btn-nb-mount-save fontsize-mount px-4"  data-toggle="modal" data-target="#add">Add</button>--}}
            </div>
{{--            <div class="mt-4 mb-0 bg-white border-top-radius-mount pr-2" style="width: fit-content;">--}}
{{--                <select class="selectpicker pl-2" name="currency_value" data-style="btn-white" data-width="auto">--}}
{{--                    <option selected disabled>Currency Value</option>--}}
{{--                    <option>11111</option>--}}
{{--                    <option>22222</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col">--}}
{{--                    <div class="mt-4 mb-0 bg-white border-top-radius-mount" style="width: 30%;">--}}
{{--                        <select class="selectpicker pl-2" name="currency_value" data-style="btn-white" data-width="auto">--}}
{{--                            <option selected disabled>Currency Value</option>--}}
{{--                            <option>11111</option>--}}
{{--                            <option>22222</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}

{{--                    <table class="table border-0 bg-white box-shadow-mount border-tab-radius-mount">--}}

{{--                        <tbody class="rounded-table-mount">--}}

{{--                        <tr>--}}
{{--                            <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">10000</td>--}}
{{--                            <td class="text-right border-top-0 pt-4">--}}
{{--                                --}}{{--                                <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1 border-0" placeholder="100" >--}}
{{--                                --}}{{--                                <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;100</label>--}}
{{--                                <p class="text-color-mount fontsize-mount2">100</p>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr class="border-0">--}}
{{--                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">5000</td>--}}
{{--                            <td class="text-right border-top-0">--}}
{{--                                <p class="text-color-mount fontsize-mount2">100</p>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}

{{--                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">1000</td>--}}
{{--                            <td class="text-right border-top-0">--}}
{{--                                <p class="text-color-mount fontsize-mount2">100</p>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">500 </td>--}}
{{--                            <td class="text-right border-top-0">--}}
{{--                                <p class="text-color-mount fontsize-mount2">100</p>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">200</td>--}}
{{--                            <td class="text-right border-top-0">--}}
{{--                                <p class="text-color-mount fontsize-mount2">100</p>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">100 </td>--}}
{{--                            <td class="text-right border-top-0">--}}
{{--                                <p class="text-color-mount fontsize-mount2">100</p>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">50 </td>--}}
{{--                            <td class="text-right border-top-0">--}}
{{--                                <p class="text-color-mount fontsize-mount2">100</p>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">10 </td>--}}
{{--                            <td class="text-right border-top-0">--}}
{{--                                <p class="text-color-mount fontsize-mount2">100</p>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td class="border-top-0 text-nb-mount" style="padding: 30px;"></td>--}}
{{--                            <td class="text-right border-top-0">--}}

{{--                                <label for="#input1" class="text-secondary">&nbsp;</label>--}}
{{--                            </td>--}}
{{--                        </tr>--}}


{{--                        </tbody>--}}

{{--                    </table>--}}
{{--                    <div class="div-p-mount2">--}}
{{--                        <p>Total : </p>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col">--}}
{{--                    --}}{{--                    <p class="row-col-p2 text-nb-mount fontsize-mount4 mb-2 ml-1">ပြန်လည်ပေးအပ်ငွေ</p>--}}
{{--                    <select class=" text-nb-mount row-col-p mb-2 ml-1 border-0 bg-transparent" style="font-size: 20px">--}}
{{--                        <option selected disabled>Currency</option>--}}
{{--                        <option>1</option>--}}
{{--                        <option>1</option>--}}
{{--                        <option>1</option>--}}
{{--                    </select>--}}
{{--                    <table class="table border-0 bg-white box-shadow-mount rounded-table-mount pb-5">--}}
{{--                        <tbody class="rounded-table-mount ">--}}

{{--                        <tr>--}}
{{--                            <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">10000 </td>--}}
{{--                            <td class="text-right border-top-0 pt-4 pb-4">--}}
{{--                                <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="100">--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr class="border-0">--}}
{{--                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">5000 </td>--}}
{{--                            <td class="text-right border-top-0 pb-4">--}}
{{--                                <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="100">--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}

{{--                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">1000 </td>--}}
{{--                            <td class="text-right border-top-0 pb-4">--}}
{{--                                <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="100">--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">500 </td>--}}
{{--                            <td class="text-right border-top-0 pb-4">--}}
{{--                                <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="100">--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">200 </td>--}}
{{--                            <td class="text-right border-top-0 pb-4">--}}
{{--                                <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="100">--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">100 </td>--}}
{{--                            <td class="text-right border-top-0 pb-4">--}}
{{--                                <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="100">--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">50 </td>--}}
{{--                            <td class="text-right border-top-0 pb-3 ">--}}
{{--                                <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="100">--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">10 </td>--}}
{{--                            <td class="text-right border-top-0 pb-4">--}}
{{--                                <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="100">--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr >--}}
{{--                            <td class="border-top-0 text-nb-mount" style="padding: 30px;"></td>--}}
{{--                            <td class="text-right border-top-0 pb-3">--}}
{{--                                <label for="#input1" class="text-color-mount">&nbsp;</label>--}}
{{--                            </td>--}}
{{--                        </tr>--}}


{{--                        </tbody>--}}

{{--                    </table>--}}
{{--                    <div class="div-p-mount2">--}}
{{--                        <p>Total :</p>--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}
            </form>

        </div>

@include('Stock.save')

        <script>

            $(function(){
                // $('#branch').hide();

                $(".stock_create").removeAttr("disabled", true);

                // $.get({
                //     url:'admin/add',
                //     success:function (data) {
                //         console.log(data);
                //         if(data==="admin_add")
                //         {
                //             $('#branch').show();
                //         }
                //         else
                //         {
                //             $('#branch').hide();
                //         }
                //     }
                // });
                // console.log(data);
                $("#stock a").addClass("active-si");
                $("#stock").addClass("active2");
                // $('.stock_create').hide();
                // $('#to_branch').hide();
                $(".stock_create").attr("disabled", true);

                $('#stock_currency_filter').on('change',function ( ) {
                   // $('.stock_create').fadeIn();
                   $(".stock_create").attr("disabled", false);


                    // $('#to_branch').fadeIn();
                });
                $(".stock_create").click(function () {
                    $(".stock_create").attr("disabled", true);
                    $('#stock_create_form').submit();
                });
                $('#to_branch').onchange(function () {
                    $branch_id=this.val();
                    alert($branch_id);
                });


            });


            function check(value) {
                $.ajax({
                    url:'check_input',
                    data:{
                        value:value,
                    },
                    dataType:'json',
                    success:function (data) {
                        console.log(data.errors.value[0]);
                        if(data.errors)
                        {
                            $('.check_input').html(data.errors.value[0]);
                        }
                    }
                });
            }
        </script>


@endsection
