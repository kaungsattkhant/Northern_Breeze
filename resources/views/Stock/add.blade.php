@extends('Layouts.master')
@section('content')

        <div class="container-nb-mount">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{url('stock/store')}}" method="post">
                @csrf
            <div class="d-flex justify-content-between top-box-mount shadow-sm">
                                <div class="my-auto">
                                    <p style="margin-left: 20px"><b>Total values:</b> $823,323,000</p>
                                </div>
                <button type="submit" class="btn btn-nb-mount-save fontsize-mount px-4 stock_create" >Add</button>
            </div>
            <select class="selectpicker pl-2" name="currency" data-style="btn-white" data-width="auto" data-live-search="true" id="stock_currency_filter">
                <option  disabled selected>Choose Currency Type</option>
                @php
                    $currencies=\App\Model\Currency::all();
                @endphp
                @foreach($currencies as $currency)
                    <option value="{{$currency->id}}"
{{--                    @if($currency->id ==1)--}}
{{--                        selected="selected"--}}
{{--                        @endif--}}
                    >{{$currency->name}}</option>

                @endforeach
            </select>

            <div class="row" id="stock_table_filter">
{{--                <div class="col">--}}

{{--                    <table class="table border-0 bg-white box-shadow-mount border-tab-radius-mount" id="stock_table_filter">--}}

{{--                        <tbody class="rounded-table-mount" >--}}

{{--                        <tr>--}}
{{--                            <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">10000</td>--}}
{{--                            <td class="text-right border-top-0 pt-4">--}}
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
{{--                <div class="col pt-4 mt-4">--}}
{{--                    <table class="table border-0 bg-white box-shadow-mount rounded-table-mount mt-2 pb-5">--}}
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
{{--                                <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="">--}}
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


            </div>
            </form>

        </div>

@include('Stock.save')

        <script>
            $(function(){
                $("#stock a").addClass("active-si");

                $("#stock").addClass("active2");
                $('.stock_create').hide();
                // $('#to_branch').hide();
                $('#stock_currency_filter').on('change',function ( ) {
                   $('.stock_create').fadeIn();
                   // $('#to_branch').fadeIn();
                });
            });
        </script>

@endsection
