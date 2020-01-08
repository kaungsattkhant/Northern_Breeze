@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
        <div class="d-flex justify-content-between top-box-mount shadow-sm">
            <div  class="my-auto ml-5">
                <div class="mb-3 pt-4 pb-1 fs-select3 d-inline">
                    <select  class="selectpicker" name="roles" title="roles" data-style="btn-white" data-width="auto" id="staff_filter">
                        <option selected disabled>Roles</option>
                        @php
                            $roles=\App\Model\Role::all();
                        @endphp
                        @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
{{--                <div class="mb-3 pt-4 pb-1 fs-select">--}}
{{--                    <select class="selectpicker show-menu-arrow ml-3 pl-2" name="Branches" data-style="btn-white" data-width="auto">--}}
{{--                        <option selected disabled>Currency</option>--}}
{{--                        <option>U.S.D Dollars</option>--}}
{{--                        <option>Chinese</option>--}}
{{--                        <option>Thailand</option>--}}
{{--                    </select>--}}

{{--                </div>--}}

                <form action="{{url('staff/search_name')}}" class="d-inline">
                    <input type="text" name="name" placeholder="Name..." class="fontsize-mount2 border-0 ml-5 pl-2 input-name">
                </form>
            </div>
            <button type="button" class="btn btn-nb-mount px-4 my-auto mr-5 fontsize-mount2"  data-toggle="modal" data-target="#create"> Add </button>
        </div>
        <div class="pt-5">
            <table class="table bg-white box-shadow-mount rounded-table-mount"  id="myTable">
                <thead>
                <tr>
{{--                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6" >#</th>--}}
                    <th scope="col" class="border-top-0 fontsize-mount6" >Name</th>
                    <th scope="col" class="border-top-0 fontsize-mount6"> Role</th>
                    <th scope="col" class=" border-top-0 text-center fontsize-mount6">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($staff as $st)
                    <tr>
{{--                        <td class="table-row-m fontsize-mount">1</td>--}}

                        <td scope="row" class="table-row-m fontsize-mount border-top-0">{{$st->name}}</td>
                        <td class="table-row-m fontsize-mount border-top-0">{{$st->role->name}}</td>
                        <td class="table-row-m text-center border-top-0">
                            <a>
                                <i class="far fa-edit mr-3 text-info"  onclick="edit({{$st->id}})"></i>
                            </a>
                            <a >
                                <i class="far fa-trash-alt text-danger" onclick="deleteStaff({{$st->id}})"></i>
                            </a>
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
            {{$staff->links()}}
        </div>
    </div>

    @include('Staff.create')
    @include('Staff.edit')
    @include('Staff.destroy')

@endsection
@section('script')
    <script src="{{asset('js/staff.js')}}"></script>
    <script src="{{asset('js/staffedit.js')}}"></script>
{{--    <script src="{{asset('js/delete.js')}}"></script>--}}
{{--    <script src="{{asset('js/multi.js')}}"></script>--}}
{{--    <script src="--}}

@endsection
