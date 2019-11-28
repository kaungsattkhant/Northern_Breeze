@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
        <div class="d-flex justify-content-between top-box-mount shadow-sm">

            <div class="my-auto ">
                <select class="selectpicker ml-4 show-menu-arrow" name="Branches" data-style="btn-white" data-width="auto" id="from_exchange_currency">

                    <option selected disabled>လဲလှယ်မည့်ငွေ</option>
                    @php
                      $currency=\App\Model\Currency::all();
                    @endphp
                    @foreach($currency as $cu)
                        <option value="{{$cu->id}}">{{$cu->name}}</option>
                    @endforeach

                </select>

                <select class="selectpicker pl-4 show-menu-arrow" name="Branches" data-style="btn-white" data-width="auto" id="to_exchange_currency">
                    <option selected disabled>ပြန်လည်ထုတ် ပေးမည့်ငွေ</option>
                    @php
                        $currency=\App\Model\Currency::all();
                    @endphp
                    @foreach($currency as $cu)
                        <option value="{{$cu->id}}">{{$cu->name}}</option>
                    @endforeach
                </select>

            </div>
            <button type="button" class="btn btn-nb-mount-save fontsize-mount" data-toggle="modal" data-target="#save">သိမ်းမည်</button>
        </div>
        <div class="row">
            <div class="col">
                <p class="border-top-radius-mount text-nb-mount mt-3 pl-3 fontsize-mount4 bg-white mb-0 pt-1 pb-2 w-25 ">လဲလှယ်မည့်ငွေ</p>
                <table class="table border-0 bg-white box-shadow-mount border-tab-radius-mount">

                    <tbody class="rounded-table-mount" id="from_exchange_table">

                    <tr>
                        <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">10000 kyats</td>
                        <td class="text-right border-top-0 pt-4 fs-select4">
                            <div id="append-div" class="d-inline-block">
                                <input type="text" class="border rounded-table-mount text-center fontsize-mount3 pt-1 for-placeholder" style="width:39.5%" placeholder="ရွက်">
                                <select class="selectpicker" data-width="fit-content">
                                    @php
                                        $classification=\App\Model\Classification::all();
                                    @endphp
                                    @foreach($classification as $c)
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="bg-transparent border-0 append-btn d-inline"><i class="fas fa-plus plus-btn-mount"></i></button>
                            <div class="add-input-select" id="mySelect">

                            </div>
                        </td>
                    </tr>
{{--                    <tr>--}}
{{--                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">5000 kyats</td>--}}
{{--                        <td class="text-right border-top-0 pt-4 fs-select4">--}}
{{--                            <div class="d-inline-block">--}}
{{--                                <input type="text" class="border rounded-table-mount text-center fontsize-mount3 pt-1 for-placeholder" style="width:39.5%" placeholder="ရွက်">--}}
{{--                                <select class="selectpicker" data-width="fit-content">--}}
{{--                                    @php--}}
{{--                                       $classification=\App\Model\Classification::all();--}}
{{--                                    @endphp--}}
{{--                                    @foreach($classification as $c)--}}
{{--                                    <option value="{{$c->id}}">{{$c->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <button class="bg-transparent border-0 myClass "><i class="fas fa-plus plus-btn-mount"></i></button>--}}
{{--                            --}}{{--                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}

{{--                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">1000 kyats</td>--}}
{{--                        <td class="text-right border-top-0 pt-4 fs-select4">--}}
{{--                            <div class="d-inline-block">--}}
{{--                                <input type="text" class="border rounded-table-mount text-center fontsize-mount3 pt-1 for-placeholder" style="width:39.5%" placeholder="ရွက်">--}}
{{--                                <select class="selectpicker" data-width="fit-content">--}}
{{--                                    <option>class a</option>--}}
{{--                                    <option>class g</option>--}}
{{--                                    <option>class z</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <button class="bg-transparent border-0 "><i class="fas fa-plus plus-btn-mount"></i></button>--}}
{{--                            --}}{{--                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">500 kyats</td>--}}
{{--                        <td class="text-right border-top-0 pt-4 fs-select4">--}}
{{--                            <div class="d-inline-block">--}}
{{--                                <input type="text" class="border rounded-table-mount text-center fontsize-mount3 pt-1 for-placeholder" style="width:39.5%" placeholder="ရွက်">--}}
{{--                                <select class="selectpicker" data-width="fit-content">--}}
{{--                                    <option>class a</option>--}}
{{--                                    <option>class g</option>--}}
{{--                                    <option>class z</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <button class="bg-transparent border-0 "><i class="fas fa-plus plus-btn-mount"></i></button>--}}
{{--                            --}}{{--                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">200 kyats</td>--}}
{{--                        <td class="text-right border-top-0 pt-4 fs-select4">--}}
{{--                            <div class="d-inline-block">--}}
{{--                                <input type="text" class="border rounded-table-mount text-center fontsize-mount3 pt-1 for-placeholder" style="width:39.5%" placeholder="ရွက်">--}}
{{--                                <select class="selectpicker" data-width="fit-content">--}}
{{--                                    <option>class a</option>--}}
{{--                                    <option>class g</option>--}}
{{--                                    <option>class z</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <button class="bg-transparent border-0"><i class="fas fa-plus plus-btn-mount"></i></button>--}}
{{--                            --}}{{--                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">100 kyats</td>--}}
{{--                        <td class="text-right border-top-0 pt-4 fs-select4">--}}
{{--                            <div class="d-inline-block">--}}
{{--                                <input type="text" class="border rounded-table-mount text-center fontsize-mount3 pt-1 for-placeholder" style="width:39.5%" placeholder="ရွက်">--}}
{{--                                <select class="selectpicker" data-width="fit-content">--}}
{{--                                    <option>class a</option>--}}
{{--                                    <option>class g</option>--}}
{{--                                    <option>class z</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <button class="bg-transparent border-0"><i class="fas fa-plus plus-btn-mount"></i></button>--}}
{{--                            --}}{{--                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">50 kyats</td>--}}
{{--                        <td class="text-right border-top-0 pt-4 fs-select4">--}}
{{--                            <div class="d-inline-block">--}}
{{--                                <input type="text" class="border rounded-table-mount text-center fontsize-mount3 pt-1 for-placeholder" style="width:39.5%" placeholder="ရွက်">--}}
{{--                                <select class="selectpicker" data-width="fit-content">--}}
{{--                                    <option>class a</option>--}}
{{--                                    <option>class g</option>--}}
{{--                                    <option>class z</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <button class="bg-transparent border-0"><i class="fas fa-plus plus-btn-mount"></i></button>--}}
{{--                            --}}{{--                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">10 kyats</td>--}}
{{--                        <td class="text-right border-top-0 pt-4 fs-select4">--}}
{{--                            <div class="d-inline-block">--}}
{{--                                <input type="text" class="border rounded-table-mount text-center fontsize-mount3 pt-1 for-placeholder" style="width:39.5%" placeholder="ရွက်">--}}
{{--                                <select class="selectpicker" data-width="fit-content">--}}
{{--                                    <option>class a</option>--}}
{{--                                    <option>class g</option>--}}
{{--                                    <option>class z</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <button class="bg-transparent border-0"><i class="fas fa-plus plus-btn-mount"></i></button>--}}
{{--                            --}}{{--                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>--}}
{{--                        </td>--}}
{{--                    </tr>--}}


                    <tr>
                        <td class="border-top-0 text-nb-mount" style="padding: 30px;"></td>
                        <td class="text-left border-top-0">

                            <p class="total-text-mount pl-5 ">Total :</p>
                            <p class="total-text-mount fontsize-mount3 pl-5">ပြန်အမ်းငွေ :</p>
                        </td>
                    </tr>

                    </tbody>

                </table>
{{--                <div class="div-p-mount2">--}}
{{--                    <p>Total :</p>--}}
{{--                    <p class="fontsize-mount3">ပြန်အမ်းငွေ :</p>--}}
{{--                </div>--}}
            </div>
            <div class="col">
                <p class="border-top-radius-mount text-nb-mount mt-3 pl-3 fontsize-mount4 bg-white mb-0 pt-1 pb-2" style="width: 27%">ပြန်လည်ပေးအပ်ငွေ</p>

                <table class="table border-0 bg-white box-shadow-mount border-tab-radius-mount">
                    <tbody class="rounded-table-mount" id="to_exchange_table">

                    <tr style="height: 70px">
                        <td class="text-nb-mount border-top-0 pl-4 padding-top-mount fontsize-mount2 pt-4">10000 kyats</td>
                        <td class="text-right border-top-0 pt-4  padding-top-mount fs-select4">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်">

                        </td>
                    </tr>
{{--                    <tr style="height: 70px">--}}
{{--                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2 ">5000 kyats</td>--}}
{{--                        <td class="text-right border-top-0 pt-4  padding-top-mount fs-select4">--}}
{{--                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်" style="">--}}

{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr style="height: 70px">--}}

{{--                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">1000 kyats</td>--}}
{{--                        <td class="text-right border-top-0 pt-4 fs-select4 padding-top-mount">--}}
{{--                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်">--}}

{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr style="height: 70px">--}}
{{--                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">500 kyats</td>--}}
{{--                        <td class="text-right border-top-0 pt-4 fs-select4 padding-top-mount">--}}
{{--                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်">--}}

{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr style="height: 70px">--}}
{{--                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">200 kyats</td>--}}
{{--                        <td class="text-right border-top-0 pt-4 fs-select4 padding-top-mount">--}}
{{--                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်">--}}

{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr style="height: 70px">--}}
{{--                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">100 kyats</td>--}}
{{--                        <td class="text-right border-top-0 pt-4 fs-select4 padding-top-mount">--}}
{{--                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်">--}}

{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr style="height: 70px">--}}
{{--                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">50 kyats</td>--}}
{{--                        <td class="text-right border-top-0 pt-4 fs-select4 padding-top-mount">--}}
{{--                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်">--}}

{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr style="height: 70px">--}}
{{--                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">10 kyats</td>--}}
{{--                        <td class="text-right border-top-0 pt-4 fs-select4 padding-top-mount">--}}
{{--                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်">--}}

{{--                        </td>--}}
{{--                    </tr>--}}

                    <tr >
                        <td class="border-top-0 text-nb-mount" style="padding: 30px;"></td>
                        <td class="text-left border-top-0">

                            <p class="total-text-mount">Total :</p>
                            <p class="total-text-mount fontsize-mount3">ပြန်အမ်းငွေ :</p>
                        </td>
                    </tr>

                    </tbody>

                </table>

            </div>
        </div>
    </div>

    @include('Member.save')
{{--    <script>--}}
{{--        $(function(){--}}
{{--            $("#pos .img-pos").addClass("active-pos");--}}

{{--            $("#pos").addClass("active2");--}}
{{--            $("#pos .img-pos").removeClass("img-pos");--}}
{{--        });--}}
{{--    </script>--}}



    @endsection
@section('script')
    <script>


        $(document).ready(function(){
            // $('.selectpick').selectpicker();
            $(".append-btn").click(function(){
                // $("#append-div").clone().appendTo("#mySelect");
                // $('.selectpick').selectpicker();
                // $(".add-input-select").append("<button class='bg-transparent border-0' id='single' >x</button>");
                $('#mySelect').append(`
                                <div class="d-inline-block appended-item ">
                                    <input type="text" class="border rounded-table-mount text-center fontsize-mount3 pt-1 for-placeholder" style="width:35.5%" placeholder="ရွက်">
                                    <select class="select-append" data-width="fit-content">
                                      @php

                                        $classification=\App\Model\Classification::all();
                                      @endphp
                    @foreach($classification as $c)
                         <option value={{$c->id}}>{{$c->name}}</option>
                    @endforeach

                                    </select>
                                    <button  class='bg-transparent border-0 delete-appended-item pad-l' onclick="deleteItem(this.id)" ><i class="fas fa-times plus-btn-mount"></i></button>
                                </div>

                `);
                $('.select-append').selectpicker();
                $.each($('.delete-appended-item'),function (ind) {
                    $(this).attr('id', 'item-' + parseInt(ind+1));
                })

            });

        });

        function deleteItem(id){
            $('#'+id).parent().remove();
        }

        $(function(){
            $("#pos .img-pos").addClass("active-pos");

            $("#pos").addClass("active2");
            $("#pos .img-pos").removeClass("img-pos");
        });


    </script>

@endsection
