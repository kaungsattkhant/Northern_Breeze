@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
        <div class="d-flex justify-content-between top-box-mount shadow-sm">
            <div  class="my-auto ml-5">
                <div class="mb-3 pt-4 pb-1 fs-select3 d-inline">
                    <select  class="selectpicker" name="roles" title="roles" data-style="btn-white" data-width="auto" id="staff_filter">
                        <option selected disabled>Roles</option>

                            <option>zz</option>
                    </select>
                </div>
                <form class="d-inline">
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

                    <tr>
                        {{--                        <td class="table-row-m fontsize-mount">1</td>--}}

                        <td scope="row" class="table-row-m fontsize-mount border-top-0">hein</td>
                        <td class="table-row-m fontsize-mount border-top-0">htet</td>
                        <td class="table-row-m text-center border-top-0">
                            <a data-toggle="modal" href="#" data-target="#edit">
                                <i class="far fa-edit mr-3 text-info"></i>
                            </a>
                            <a data-toggle="modal" href="#" data-target="#delete">
                                <i class="far fa-trash-alt text-danger"></i>
                            </a>
                        </td>
                    </tr>


                </tbody>
            </table>
        </div>
    </div>

    @include('Branch.create')
    @include('Branch.edit')
    @include('Branch.destroy')

@endsection

@section('script')
    <script>
        $(function(){
            $("#branch a").addClass("active-branch");

            $("#branch").addClass("active2");

        });
    </script>

@endsection
