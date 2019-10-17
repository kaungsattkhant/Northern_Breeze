@extends('Layouts.master')
@section('content')
    <div class="container-nb-mount">
        <div class="d-flex justify-content-between top-box-mount shadow-sm">
            <div  class="my-auto btnzz ml-4  dropdown">
                <button type="button" class="btn mr-5 dropdown-toggle fontsize-mount2 pl-4 text-color-mount " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Member Roles&nbsp;<i class="fas fa-chevron-down text-color-mount2 pl-1"></i></button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">One</a>
                    <a class="dropdown-item" href="#">Two</a>
                    <a class="dropdown-item" href="#">Three</a>
                </div>


                <button type="button" class="btn fontsize-mount2 text-color-mount px-4" onclick="sortTable(0)">Name</button>
            </div>
            <button type="button" class="btn btn-nb-mount px-4 my-auto mr-5 fontsize-mount2"  data-toggle="modal" data-target="#create"> Add </button>
        </div>
        <div class="pt-5">
            <table class="table bg-white box-shadow-mount rounded-table-mount"  id="myTable">
                <thead>
                <tr>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6" >Name</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Member Role</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Point</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Phone Number</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td scope="row" class="table-row-m"><a href="member-data.html" class="text-decoration-none text-dark fontsize-mount2">Khant</a></td>
                    <td class="table-row-m fontsize-mount2">Diamond</td>
                    <td class="table-row-m fontsize-mount2">10000</td>
                    <td class="table-row-m fontsize-mount2">09785423364</td>
                    <td class="table-row-m fontsize-mount2">
                        <a href="#" data-toggle="modal" data-target="#edit">
                            <i class="far fa-edit mr-3 text-info"></i>
                        </a>
                        <a href="#" data-toggle="modal" data-target="#destroy">
                            <i class="far fa-trash-alt text-danger"></i>
                        </a>
                    </td>
                </tr>


                </tbody>
            </table>
        </div>

    </div>
    @include('Member.create')
    @include('Member.edit')
    @include('Member.destroy')
    @endsection
@section('script')
    <script src="{{asset('js/member.js')}}"></script>
    @endsection

