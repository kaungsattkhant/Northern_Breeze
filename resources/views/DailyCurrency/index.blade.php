@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
        <div class="d-flex justify-content-between top-box-mount box-shadow-mount2">
            <div  class="my-auto btnzz ml-4">
                <label class="text-color-mount">Daily Currency</label>
                {{--                <input type="text" name="name" placeholder="Name..." class="fontsize-mount2 border-0 ml-5 pl-2 input-name">--}}
            </div>
            <button type="button" class="btn btn-nb-mount px-4 my-auto mr-5 fontsize-mount2"  data-toggle="modal" data-target="#create"> Add </button>
        </div>
        <div class="pt-5">
            <div class="bg-white rounded-table-mount box-shadow-mount2 pb-5 px-2">
                <div class="mb-3 pt-3 pb-1  ">
                    <select class="border-0 rounded-0  bg-white  text-color-mount fontsize-mount18 ml-4 pl-2 btn-m" style="height: 50px;" id="daily_currency_filter">
                        <option selected disabled style="background-color: #e8e8e8;">Currency</option>
                        @php
                           $currencies=\App\Model\Currency::all();
                        @endphp
                        @foreach($currencies as $currency)
                            <option style="background-color: #f7f7f7;" value="{{$currency->id}}"
{{--                            @if($currency->id==18)--}}
{{--                                selected="selected"--}}
{{--                                @endif--}}
                            >{{$currency->name}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="container" id="daily">
                    <div id="group">

                    </div>
{{--                                                    groupname part1                --}}
                    <div class="row pl-1">
                        <div class="col-4">
                            <label class="pl-3 text-color-mount fontsize-mount pr-4 my-auto">Group Name</label>
                        </div>
                        <div class="col col-item ">
                            <p class="text-color-mount fontsize-mount17 pt-1">ISIS</p>
                        </div>

                        <div class="col col-item ">
                            <p class="text-color-mount fontsize-mount17 pt-1">KIA</p>
                        </div>
                        <div class="col col-item ">
                            <p class="text-color-mount fontsize-mount17 pt-1">KNU</p>
                                                        <br><small>(100)</small>
                        </div>
                    </div>
{{--                                                        groupname part2--}}
                    <div class="row mb-1 pl-1">
                        <div class="col-4">
{{--                                                        emptyspace--}}
                        </div>
                        <div class="col">
                            <p class="text-color-mount fontsize-mount2 pt-1 text-center">(100)</p>
                        </div>

                        <div class="col">
                            <p class="text-color-mount fontsize-mount2 pt-1 text-center">(200)</p>
                        </div>
                        <div class="col">
                            <p class="text-color-mount fontsize-mount2 pt-1 text-center">(500)</p>
                        </div>
                    </div>
{{--                                                                                              selling value--}}
                    <div class="row  pl-1">
                        <div class="col-4">
                            <label class="pl-3 text-color-mount fontsize-mount pr-4 my-auto">Selling Value</label>
                        </div>
                        <div class="col col-item ">
                            <p class="text-color-mount fontsize-mount17 pt-1">100</p>
                        </div>
                        <div class="col col-item ">
                            <p class="text-color-mount fontsize-mount17 pt-1">200</p>
                        </div>
                        <div class="col col-item ">
                            <p class="text-color-mount fontsize-mount17 pt-1">15kyats</p>
                        </div>
                    </div>
{{--                                                            selling value 2nd role--}}
                    <div class="row mb-1 pl-1">
                        <div class="col-4">

                        </div>
                        <div class="col">
                            <p class="text-color-mount fontsize-mount2 pt-1 text-center">(100)</p>
                        </div>

                        <div class="col">
                            <p class="text-color-mount fontsize-mount2 pt-1 text-center">(200)</p>
                        </div>
                        <div class="col">
                            <p class="text-color-mount fontsize-mount2 pt-1 text-center">(500)</p>
                        </div>
                    </div>
{{--                                                                            buying value--}}
                    <div class="row mb-1 pl-1">
                        <div class="col-4">
                            <label class="pl-3 text-color-mount fontsize-mount pr-4 mt-3">Buying Value</label>
                        </div>
                        <div class="col mb-4">
                            <div class="row">
                                <div class="col col-item2">
                                    <p class="text-color-mount fontsize-mount17 pt-1">10000</p>
                                </div>
                                <div class="col">
                                    <div class="col-item-mini text-color-mount fontsize-mount2">
                                        <input type="text" placeholder="Class A" class="pl-3" style="width: 100%;border: none;background-color: transparent">
                                    </div>
                                    <div class="col-item-mini text-color-mount fontsize-mount2 ">
                                        <input type="text" placeholder="Class B" class="pl-3" style="width: 100%;border: none;background-color: transparent">
                                    </div>
                                    <div class="col-item-mini text-color-mount fontsize-mount2">
                                        <input type="text" placeholder="Class C" class="pl-3" style="width: 100%;border: none;background-color: transparent">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col mb-4">
                            <div class="row">
                                <div class="col col-item2">
                                    <p class="text-color-mount fontsize-mount17 pt-1">2000</p>
                                </div>
                                <div class="col">
                                    <div class="col-item-mini text-color-mount fontsize-mount2">
                                        <input type="text" placeholder="Class A" class="pl-3" style="width: 100%;border: none;background-color: transparent">
                                    </div>
                                    <div class="col-item-mini text-color-mount fontsize-mount2 ">
                                        <input type="text" placeholder="Class B" class="pl-3" style="width: 100%;border: none;background-color: transparent">
                                    </div>
                                    <div class="col-item-mini text-color-mount fontsize-mount2">
                                        <input type="text" placeholder="Class C" class="pl-3" style="width: 100%;border: none;background-color: transparent">
                                    </div>

                                </div>


                            </div>
                        </div>
                        <div class="col mb-4">
                            <div class="row">
                                <div class="col col-item2">
                                    <p class="text-color-mount fontsize-mount17 py-1">15kyats</p>
                                </div>
                                <div class="col">
                                    <div class="col-item-mini text-color-mount fontsize-mount2">
                                        <input type="text" placeholder="Class A" class="pl-3" style="width: 100%;border: none;background-color: transparent">
                                    </div>
                                    <div class="col-item-mini text-color-mount fontsize-mount2 ">
                                        <input type="text" placeholder="Class B" class="pl-3" style="width: 100%;border: none;background-color: transparent">
                                    </div>
                                    <div class="col-item-mini text-color-mount fontsize-mount2">
                                        <input type="text" placeholder="Class C" class="pl-3" style="width: 100%;border: none;background-color: transparent">
                                    </div>

                                </div>
                            </div>
                        </div>



                    </div>

                </div>

            </div>



        </div>
    </div>

    {{--    @include('Staff.create')--}}
    {{--    @include('Staff.edit')--}}
    {{--    @include('Staff.destroy')--}}
    <script>
        $(function(){
            $("#daily a").addClass("active-daily");

            $("#daily").addClass("active2");

        });
    </script>
@section('script')
    <script src="{{asset('js/dailycurrency.js')}}"></script>
{{--    <script src="{{asset('js/dailycurrency.js')}}"></script>--}}
@endsection
@endsection


