@extends('Layouts.master')
@section('content')
    <div class="container-nb-mount">
        <div class="d-flex justify-content-between top-box-mount shadow-sm">
            <div  class="my-auto btnzz ml-4  dropdown">
                <button type="button" class="btn mr-5 dropdown-toggle fontsize-mount6 pl-3 text-color-mount " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Roles&nbsp;<i class="fas fa-chevron-down text-color-mount2 pl-1"></i></button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">One</a>
                    <a class="dropdown-item" href="#">Two</a>
                    <a class="dropdown-item" href="#">Three</a>
                </div>
                <button type="button" class="btn fontsize-mount6 text-color-mount px-4" onclick="sortTable(0)">Name</button>
            </div>
            <button type="button" class="btn btn-nb-mount px-4 my-auto mr-5 fontsize-mount2"  data-toggle="modal" data-target="#create"> Add </button>
        </div>
        <div class="pt-5">
            <table class="table bg-white box-shadow-mount rounded-table-mount"  id="myTable">
                <thead>
                <tr>
{{--                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6" >#</th>--}}
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6" >Name</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6"> Role</th>
                    <th scope="col" class="border-bottom-0 border-top-0 text-center fontsize-mount6">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($staff as $st)
                    <tr>
{{--                        <td class="table-row-m fontsize-mount">1</td>--}}

                        <td scope="row" class="table-row-m fontsize-mount">{{$st->name}}</td>
                        <td class="table-row-m fontsize-mount">{{$st->role->name}}</td>
                        <td class="table-row-m text-center">
                            <a>
                                <i class="far fa-edit mr-3 text-info"  onclick="edit({{$st->id}})"></i>
                            </a>
                            <a href="#" data-toggle="modal" data-target="#Delete">
                                <i class="far fa-trash-alt text-danger"></i>
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
@endsection
