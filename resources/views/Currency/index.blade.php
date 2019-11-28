@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
        <div>
            <form action="{{url('currency_group/store')}}" method="post">
                @csrf


                <div class="bg-white row m-0 pb-3 border-bottom-radius-mount pt-4">
                    <div class="col ml-4 fs-select4">
                        <label for="#currency" class="w-25 fontsize-mount6 d-block pl-2 ml-1"> Currency</label>
                        @php
                            $currencies=\App\Model\Currency::all();
                        @endphp
                        <select class="selectpicker show-menu-arrow"  id="currency" name="currency" title="Choose one..." data-style="btn-white">

                            @foreach($currencies as $currency)
                                <option value="{{$currency->id}}">{{$currency->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="#GN" class="fontsize-mount d-block">Group Name</label>
                        <input type="text" id="GN" name="group_name" class="border-top-0 border-right-0 border-left-0 rounded-0 bd-bottom-mount fontsize-mount" placeholder="">
                    </div>
                    <div class="col">
                        <label for="" class="fontsize-mount d-block pl-2 ml-1">Note</label>
                        <div class="d-block fs-select4" style=";position: relative" >
                            <select class="selectpicker show-menu-arrow" multiple data-selected-text-format="count > 5" title="Select options" name="notes[]">
                                @php
                                    $notes=\App\Model\Note::all();
                                @endphp
                                @foreach($notes as $note)
                                    <option value="{{$note->id}}">{{$note->name}}</option>
                                @endforeach
                            </select>
{{----}}
{{----}}
                        </div>
                    </div>
                    <div class="col my-auto">
                        <button type="submit" class="btn btn-nb-mount px-4 my-auto  fontsize-mount2"  data-toggle="modal" data-target="#create"  style="margin-left: 120px"> Add </button>

                    </div>
                </div>
{{--                <div class="bg-white table border-0 bg-white box-shadow-mount rounded-table-mount col-lg-5 mt-5">--}}
{{--                    <div class="p-3">--}}
{{--                        <div class="mb-2 pr-5">--}}
{{--                            <label for="#currency" class="w-25 fontsize-mount"> Currency</label>--}}
{{--                            <select class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input3 bg-white text-secondary bd-bottom-mount fontsize-mount22" id="currency" name="currency">--}}
{{--                                <option selected disabled>--None--</option>--}}
{{--                                @php--}}
{{--                                    $currencies=\App\Model\Currency::all();--}}
{{--                                @endphp--}}
{{--                                @foreach($currencies as $currency)--}}
{{--                                    <option value="{{$currency->id}}">{{$currency->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="mb-1">--}}
{{--                            <label for="#GN" class="w-25 pt-2 fontsize-mount">Group Name</label>--}}
{{--                            <input type="text" id="GN" name="group_name" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input3 bd-bottom-mount">--}}
{{--                        </div>--}}
{{--                        <div class="mb-1 ">--}}
{{--                            <p class="w-25 pt-2 fontsize-mount " style="position: absolute;left:30px">Note</p>--}}
{{--                            <div class="d-inline w-50 "style="left: 49%;position: relative" >--}}
{{--                                <select id="multi_select" multiple="multiple" name="notes[]">--}}
{{--                                    @php--}}
{{--                                        $notes=\App\Model\Note::all();--}}
{{--                                    @endphp--}}
{{--                                    @foreach($notes as $note)--}}
{{--                                        <option value="{{$note->id}}">{{$note->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{----}}
{{----}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
            </form>

        </div>

         <table class="table bg-white box-shadow-mount rounded-table-mount mt-5"  id="myTable">
             <thead>
                <tr>
                    {{--                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6" >#</th>--}}
                    <th scope="col" class=" border-top-0 fontsize-mount6" >Name</th>
                    <th scope="col" class=" border-top-0 fontsize-mount6"> Group Name</th>
                    <th scope="col" class=" border-top-0 text-center fontsize-mount6">Action</th>
                </tr>
             </thead>
             <tbody>
{{--             @if($currency_groups!=null)--}}
                 @foreach($currency_groups as $currency_group)
                     <tr>
                         <td scope="row" class="table-row-m fontsize-mount border-top-0">{{$currency_group->name}}</td>
                         <td class="table-row-m fontsize-mount border-top-0">{{$currency_group->currency->name}}</td>
                         <td class="table-row-m text-center border-top-0">
                             <form action="{{url('currency_group/'.$currency_group->id.'/edit')}}" method="get" class="d-inline">
                                 <a>

                                     <button  class="border-0 bg-transparent"><i class="far fa-edit mr-3 text-info"> </i></button>
                                 </a>
                             </form>
                             <a class="d-inline" >
                                 <i class="far fa-trash-alt text-danger" onclick="deleteCurrencyGroup({{$currency_group->id}})"></i>
                             </a>
                         </td>
                     </tr>
                 @endforeach
             </tbody>
         </table>

    </div>
    @include('Currency.destroy')
    <script>
        $(function(){
            $("#group a").addClass("active-group");

            $("#group").addClass("active2");



        });
        function deleteCurrencyGroup ($id)
        {
            // alert($id);
            $('#delete_id').val($id);
            $('#destroy').modal('show');
        }

    </script>
@endsection

