@extends('Layouts.master')
@section('content')

        <div class="container-nb-mount">
            <div class="d-flex justify-content-between top-box-mount shadow-sm">
                                <div class="my-auto">
                                    <select class="selectpicker ml-4" name="total_value" data-style="btn-white" data-width="auto">
                                        <option selected disabled>Total Value</option>
                                        <option>11111</option>
                                        <option>22222</option>
                                    </select>


                                </div>

                <button type="button" class="btn btn-nb-mount-save fontsize-mount px-4"  data-toggle="modal" data-target="#add">Add</button>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mt-4 mb-0 bg-white border-top-radius-mount" style="width: 30%;">
                        <select class="selectpicker pl-2" name="currency_value" data-style="btn-white" data-width="auto">
                            <option selected disabled>Currency Value</option>
                            <option>11111</option>
                            <option>22222</option>
                        </select>
                    </div>
{{--                    <select class=" text-nb-mount row-col-p mb-0 border-0 bg-white border-top-radius-mount " style="font-size: 20px;">--}}
{{--                        <option selected disabled>Currency value</option>--}}
{{--                        <option>1</option>--}}
{{--                        <option>1</option>--}}
{{--                        <option>1</option>--}}
{{--                    </select>--}}
                    <table class="table border-0 bg-white box-shadow-mount border-tab-radius-mount">

                        <tbody class="rounded-table-mount">

                        <tr>
                            <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">10000</td>
                            <td class="text-right border-top-0 pt-4">
                                {{--                                <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1 border-0" placeholder="100" >--}}
                                {{--                                <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;100</label>--}}
                                <p class="text-color-mount fontsize-mount2">100</p>
                            </td>
                        </tr>
                        <tr class="border-0">
                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">5000</td>
                            <td class="text-right border-top-0">
                                <p class="text-color-mount fontsize-mount2">100</p>
                            </td>
                        </tr>
                        <tr>

                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">1000</td>
                            <td class="text-right border-top-0">
                                <p class="text-color-mount fontsize-mount2">100</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">500 </td>
                            <td class="text-right border-top-0">
                                <p class="text-color-mount fontsize-mount2">100</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">200</td>
                            <td class="text-right border-top-0">
                                <p class="text-color-mount fontsize-mount2">100</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">100 </td>
                            <td class="text-right border-top-0">
                                <p class="text-color-mount fontsize-mount2">100</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">50 </td>
                            <td class="text-right border-top-0">
                                <p class="text-color-mount fontsize-mount2">100</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">10 </td>
                            <td class="text-right border-top-0">
                                <p class="text-color-mount fontsize-mount2">100</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-top-0 text-nb-mount" style="padding: 30px;"></td>
                            <td class="text-right border-top-0">

                                <label for="#input1" class="text-secondary">&nbsp;</label>
                            </td>
                        </tr>


                        </tbody>

                    </table>
                    <div class="div-p-mount2">
                        <p>Total : </p>

                    </div>
                </div>
                <div class="col pt-4 mt-4">
                    {{--                    <p class="row-col-p2 text-nb-mount fontsize-mount4 mb-2 ml-1">ပြန်လည်ပေးအပ်ငွေ</p>--}}
{{--                    <select class=" text-nb-mount row-col-p mb-2 ml-1 border-0 bg-transparent" style="font-size: 20px">--}}
{{--                        <option selected disabled>Currency</option>--}}
{{--                        <option>1</option>--}}
{{--                        <option>1</option>--}}
{{--                        <option>1</option>--}}
{{--                    </select>--}}
                    <table class="table border-0 bg-white box-shadow-mount rounded-table-mount mt-2 pb-5">
                        <tbody class="rounded-table-mount ">

                        <tr>
                            <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">10000 </td>
                            <td class="text-right border-top-0 pt-4 pb-4">
                                <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="100">
                            </td>
                        </tr>
                        <tr class="border-0">
                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">5000 </td>
                            <td class="text-right border-top-0 pb-4">
                                <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="100">
                            </td>
                        </tr>
                        <tr>

                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">1000 </td>
                            <td class="text-right border-top-0 pb-4">
                                <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="100">
                            </td>
                        </tr>
                        <tr>
                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">500 </td>
                            <td class="text-right border-top-0 pb-4">
                                <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="100">
                            </td>
                        </tr>
                        <tr>
                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">200 </td>
                            <td class="text-right border-top-0 pb-4">
                                <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="100">
                            </td>
                        </tr>
                        <tr>
                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">100 </td>
                            <td class="text-right border-top-0 pb-4">
                                <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="100">
                            </td>
                        </tr>
                        <tr>
                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">50 </td>
                            <td class="text-right border-top-0 pb-3 ">
                                <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="100">
                            </td>
                        </tr>
                        <tr>
                            <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">10 </td>
                            <td class="text-right border-top-0 pb-4">
                                <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="100">
                            </td>
                        </tr>
                        <tr >
                            <td class="border-top-0 text-nb-mount" style="padding: 30px;"></td>
                            <td class="text-right border-top-0 pb-3">
                                <label for="#input1" class="text-color-mount">&nbsp;</label>
                            </td>
                        </tr>


                        </tbody>

                    </table>
                    <div class="div-p-mount2">
                        <p>Total :</p>
                    </div>

                </div>
            </div>
        </div>

@include('Stock.save')

        <script>
            $(function(){
                $("#stock a").addClass("active-si");

                $("#stock").addClass("active2");

            });
        </script>

@endsection
