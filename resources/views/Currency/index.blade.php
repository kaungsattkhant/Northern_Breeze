@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
        <form action="{{url('currency_group/store')}}" method="post">
            @csrf
        <div class="d-flex justify-content-between top-box-mount shadow-sm">
            <div  class="my-auto btnzz ml-4">
{{--                <div class="d-inline">--}}
{{--                    <button type="button" class="btn mr-5 dropdown-toggle fontsize-mount6 pl-4 text-color-mount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Member Roles&nbsp;<i class="fas fa-chevron-down text-color-mount2 pl-1"></i></button>--}}
{{--                    <div class="dropdown-menu">--}}
{{--                        <a class="dropdown-item" href="#">One</a>--}}
{{--                        <a class="dropdown-item" href="#">Two</a>--}}
{{--                        <a class="dropdown-item" href="#">Three</a>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="d-inline">--}}
{{--                    <button type="button" class="btn fontsize-mount6 text-color-mount pl-3 pr-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                        Branch&nbsp;<i class="fas fa-chevron-down text-color-mount2 pl-1"></i>--}}
{{--                    </button>--}}
{{--                    <div class="dropdown-menu">--}}
{{--                        <a class="dropdown-item" href="#">IN</a>--}}
{{--                        <a class="dropdown-item" href="#">OUT</a>--}}
{{--                        <a class="dropdown-item" href="#">ALL</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <input type="text" name="name" placeholder="Name..." class="fontsize-mount2 border-0 ml-5 pl-2 input-name">--}}
            </div>
            <button type="submit" class="btn btn-nb-mount px-4 my-auto mr-5 fontsize-mount2"  > Add </button>
        </div>
        <div class="pt-5">
            <div class="bg-white table border-0 bg-white box-shadow-mount rounded-table-mount col-sm-5">
{{--                <form action="{{url('currency_group/store')}}" method="post">--}}
                    <div class="p-3">
                        <div class="mb-2 pr-5">
                            <label for="#currency" class="w-25 fontsize-mount"> Currency</label>
                            <select class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input3 bg-white text-secondary bd-bottom-mount fontsize-mount22" id="currency" name="currency">
                                <option selected disabled>--None--</option>
                                @php
                                    $currencies=\App\Model\Currency::all();
                                @endphp
                                @foreach($currencies as $currency)
                                    <option value="{{$currency->id}}">{{$currency->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="#GN" class="w-25 pt-2 fontsize-mount">Group Name</label>
                            <input type="text" id="GN" name="group_name" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input3 bd-bottom-mount">
                        </div>
                        <div class="mb-1 ">
                            <p class="w-25 pt-2 fontsize-mount " style="position: absolute;left:30px">Note</p>
{{--                            <span class="pt-2 w-25 fontsize-mount d-inline">NOte</span>--}}
                            <div class="d-inline  w-50 "style="left: 220px;position: relative" >
                                <select id="multi_select" multiple="multiple" name="notes[]">
                                    @php
                                        $notes=\App\Model\Note::all();
                                    @endphp
                                    @foreach($notes as $note)
                                        <option value="{{$note->id}}">{{$note->name}}</option>
                                    @endforeach
                                </select>

{{--                                <div class=" mount-input4">--}}
{{--                                    <label for="#usa" class="w-75 pt-2 fontsize-mount">Chinese</label>--}}
{{--                                    <input type="checkbox" id="usa" class=" ">--}}

{{--                                </div>--}}

{{--                                <div class=" mount-input4">--}}
{{--                                    <label for="#usa" class="w-75 pt-2 fontsize-mount">Japanese</label>--}}
{{--                                    <input type="checkbox" id="usa" class=" ">--}}

{{--                                </div>--}}
{{--                                <div class=" mount-input4">--}}
{{--                                    <label for="#usa" class="w-75 pt-2 fontsize-mount">Burma</label>--}}
{{--                                    <input type="checkbox" id="usa" class=" ">--}}

{{--                                </div>--}}
{{--                                <div class=" mount-input4">--}}
{{--                                    <label for="#usa" class="w-75 pt-2 fontsize-mount">Iraq</label>--}}
{{--                                    <input type="checkbox" id="usa" class=" ">--}}

{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
            </div>

{{--            <table class="table bg-white box-shadow-mount rounded-table-mount"  id="myTable">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    --}}{{--                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6" >#</th>--}}
{{--                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6" >Name</th>--}}
{{--                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6"> Role</th>--}}
{{--                    <th scope="col" class="border-bottom-0 border-top-0 text-center fontsize-mount6">Action</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}

{{--                    <tr>--}}
{{--                        --}}{{--                        <td class="table-row-m fontsize-mount">1</td>--}}

{{--                        <td scope="row" class="table-row-m fontsize-mount">a</td>--}}
{{--                        <td class="table-row-m fontsize-mount">b</td>--}}
{{--                        <td class="table-row-m text-center">--}}
{{--                            <a>--}}
{{--                                <i class="far fa-edit mr-3 text-info"></i>--}}
{{--                            </a>--}}
{{--                            <a href="#" data-toggle="modal" data-target="#Delete">--}}
{{--                                <i class="far fa-trash-alt text-danger"></i>--}}
{{--                            </a>--}}
{{--                        </td>--}}
{{--                    </tr>--}}


{{--                </tbody>--}}
{{--            </table>--}}

        </div>
        </form>

    </div>
    <script>
        $(function(){
            $("#group a").addClass("active-group");

            $("#group").addClass("active2");

        });
    </script>
@endsection

