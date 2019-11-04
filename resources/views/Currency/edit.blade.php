@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
        <div>
            <form action="{{url('currency_group/update')}}" method="post">
                @csrf
                @method('patch')
                <input type="hidden" name="id" value="{{$currency_groups->id}}">
                <div class="d-flex justify-content-between top-box-mount shadow-sm">
                    <div  class="my-auto btnzz ml-4">
                    </div>
                    <button type="submit" class="btn btn-nb-mount px-4 my-auto mr-5 fontsize-mount2"  data-toggle="modal" data-target="#create"> Save </button>
                </div>

                <div class="bg-white table border-0 bg-white box-shadow-mount rounded-table-mount col-lg-5 mt-5">
                    <div class="p-3">
                        <div class="mb-2 pr-5">
                            <label for="#currency" class="w-25 fontsize-mount"> Currency</label>
                            <select class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input3 bg-white text-secondary bd-bottom-mount fontsize-mount22" id="currency" name="currency">
                                <option selected disabled>--None--</option>
                                @php
                                    $currencies=\App\Model\Currency::all();
                                @endphp
                                @foreach($currencies as $currency)
                                    <option value="{{$currency->id}}"
                                    @if($currency->id==$currency_groups->currency->id)
                                        selected="selected"
                                        @endif
                                    >{{$currency->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="#GN" class="w-25 pt-2 fontsize-mount">Group Name</label>
                            <input type="text" id="GN" name="group_name" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input3 bd-bottom-mount" value="{{$currency_groups->name}}">
                        </div>
                        <div class="mb-1 ">
                            <p class="w-25 pt-2 fontsize-mount " style="position: absolute;left:30px">Note</p>
                            <div class="d-inline  w-50 "style="left: 220px;position: relative" >
                                <select id="multi_select" multiple="multiple" name="notes[]">
                                    @php
                                        $notes=\App\Model\Note::all();
                                    @endphp
                                    @foreach($notes as $note)
                                        <option value="{{$note->id}}"
                                        @if($currency_groups->notes->containsStrict('id',$note->id)) selected="selected" @endif
                                        >{{$note->name}}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                    </div>

                </div>
            </form>

        </div>

{{--        <table class="table bg-white box-shadow-mount rounded-table-mount mt-5"  id="myTable">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                --}}{{--                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6" >#</th>--}}
{{--                <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6" >Name</th>--}}
{{--                <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6"> Role</th>--}}
{{--                <th scope="col" class="border-bottom-0 border-top-0 text-center fontsize-mount6">Action</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            --}}
{{--            @foreach($currency_groups as $currency_group)--}}
{{--                <tr>--}}
{{--                    <td scope="row" class="table-row-m fontsize-mount">{{$currency_group->name}}</td>--}}
{{--                    <td class="table-row-m fontsize-mount">{{$currency_group->currency->name}}</td>--}}
{{--                    <td class="table-row-m text-center">--}}
{{--                            <a>--}}
{{--                                <i class="far fa-edit mr-3 text-info"></i>--}}
{{--                            </a>--}}

{{--                        <a href="#" data-toggle="modal" data-target="#Delete">--}}
{{--                            <i class="far fa-trash-alt text-danger"></i>--}}
{{--                        </a>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--     --}}

{{--            </tbody>--}}
{{--        </table>--}}


    </div>

    {{--    </div>--}}
    <script>
        $(function(){
            $("#group a").addClass("active-group");

            $("#group").addClass("active2");

        });
    </script>
@endsection

