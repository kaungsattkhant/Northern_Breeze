@extends('Layouts.master')
@section('content')

    <member currencies="{{$currencies}}"></member>

{{--    <div class="container-nb-mount">--}}
{{--            <div>--}}
{{--                <table class="table bg-white border-bottom-radius-mount mb-4">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6 pl-4" >Name</th>--}}
{{--                        <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6 text-center">Member Role</th>--}}
{{--                        <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6 text-right pr-5">Point</th>--}}

{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    <tr>--}}
{{--                        <td scope="row" class="table-row-m fontsize-mount2 border-top-0 pl-4 text-color-mount">Khant</td>--}}
{{--                        <td class="table-row-m fontsize-mount2 border-top-0 text-center text-color-mount">Diamond</td>--}}
{{--                        <td class="table-row-m fontsize-mount2 border-top-0 text-right pr-5 text-color-mount">10000</td>--}}

{{--                    </tr>--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        <form action="{{url('pos_member_store')}}" method="post">--}}

{{--          <div>--}}
{{--                <div class="d-flex justify-content-between  top-box-mount shadow-sm border-top-radius-mount">--}}
{{--                    <div class="my-auto fs-select2">--}}

{{--                        <select class="selectpicker ml-4 show-menu-arrow" name="from_currency" data-style="btn-white" data-width="auto" id="from_exchange_currency">--}}
{{--                            <option selected disabled>လဲလှယ်မည့်ငွေ</option>--}}
{{--                            @php--}}
{{--                                $currency=\App\Model\Currency::all();--}}
{{--                            @endphp--}}
{{--                            @foreach($currency as $cu)--}}
{{--                                <option value="{{$cu->id}}">{{$cu->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}

{{--                        <select class="selectpicker pl-4 show-menu-arrow" name="to_currency" data-style="btn-white" data-width="auto" id="to_exchange_currency">--}}
{{--                            <option selected disabled>ပြန်လည်ထုတ် ပေးမည့်ငွေ</option>--}}
{{--                            @php--}}
{{--                                $currency=\App\Model\Currency::all();--}}
{{--                            @endphp--}}
{{--                            @foreach($currency as $cu)--}}
{{--                                <option value="{{$cu->id}}">{{$cu->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}

{{--                    </div>--}}
{{--                    <button type="submit" class="btn btn-nb-mount-save fontsize-mount" id="memer_store">သိမ်းမည်</button>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        <div class="row ">--}}
{{--                <div class="col">--}}
{{--                    <p class="border-top-radius-mount text-nb-mount mt-3 pl-3 fontsize-mount4 bg-white mb-0 pt-1 pb-2 w-25 ">လဲလှယ်မည့်ငွေ</p>--}}
{{--                    <table class="table border-0 bg-white box-shadow-mount border-tab-radius-mount">--}}

{{--                        <tbody class="rounded-table-mount" id="from_exchange_table">--}}



{{--                        </tbody>--}}

{{--                    </table>--}}
{{--                </div>--}}
{{--                <div class="col">--}}
{{--                    <p class="border-top-radius-mount text-nb-mount mt-3 pl-3 fontsize-mount4 bg-white mb-0 pt-1 pb-2" style="width: 27%">ပြန်လည်ပေးအပ်ငွေ</p>--}}
{{--                    <table class="table border-0 bg-white box-shadow-mount border-tab-radius-mount" >--}}
{{--                        <tbody class="rounded-table-mount" id="to_exchange_table">--}}
{{--                        </tbody>--}}

{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--        </div>--}}

{{--    @include('Member.save')--}}
{{--        <script>--}}
{{--            $(function(){--}}
{{--                $("#pos .img-pos").addClass("active-pos");--}}
{{--                --}}{{--$("#zzz").css("background-image","url('{{URL::asset('storage/image/banknotes.png')}}')");--}}
{{--                $("#pos").addClass("active2");--}}
{{--                $("#pos .img-pos").removeClass("img-pos");--}}
{{--            });--}}
{{--        </script>--}}



@endsection
@section('script')
    <script>


        {{--$(document).ready(function(){--}}
        {{--    $("#pos .img-pos").addClass("active-pos");--}}
        {{--    --}}{{--$("#zzz").css("background-image","url('{{URL::asset('storage/image/banknotes.png')}}')");--}}
        {{--    $("#pos").addClass("active2");--}}
        {{--    $("#pos .img-pos").removeClass("img-pos");--}}
        {{--    // $('.selectpick').selectpicker();--}}
        {{--    $(".append-btn").click(function(){--}}
        {{--        // $("#append-div").clone().appendTo("#mySelect");--}}
        {{--        // $('.selectpick').selectpicker();--}}
        {{--        // $(".add-input-select").append("<button class='bg-transparent border-0' id='single' >x</button>");--}}
        {{--        $('#mySelect').append(`--}}
        {{--                        <div class="d-inline-block appended-item">--}}
        {{--                            <input type="text" class="border rounded-table-mount text-center fontsize-mount3 pt-1 for-placeholder" style="width:35.5%" placeholder="ရွက်">--}}
        {{--                            <select class="select-append" data-width="fit-content">--}}
        {{--                                <option>class a</option>--}}
        {{--                                <option>class g</option>--}}
        {{--                                <option>class z</option>--}}
        {{--                            </select>--}}
        {{--                            <button  class='bg-transparent border-0 delete-appended-item pad-l' onclick="deleteItem(this.id)" ><i class="fas fa-times plus-btn-mount"></i></button>--}}
        {{--                        </div>--}}

        {{--        `);--}}
        {{--        $('.select-append').selectpicker();--}}
        {{--        $.each($('.delete-appended-item'),function (ind) {--}}
        {{--            $(this).attr('id', 'item-' + parseInt(ind+1));--}}
        {{--        })--}}

        {{--    });--}}

        {{--});--}}

        {{--function deleteItem(id){--}}
        {{--   $('#'+id).parent().remove();--}}
        {{--}--}}




    </script>

    @endsection
