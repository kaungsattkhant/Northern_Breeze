@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
        <div class="d-flex justify-content-between top-box-mount shadow-sm">
            <div  class="my-auto btnzz ml-4">
                <select class="border-0 rounded-0  bg-white  text-color-mount fontsize-mount pl-4 btn-m" style="height: 50px;">
                    <option selected disabled>Member Roles</option>
                    <option>1111</option>
                    <option>22222</option>
                </select>

{{--                <div class="d-inline">--}}
{{--                    <button type="button" class="btn fontsize-mount6 text-color-mount pl-3 pr-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                        In/Out/All&nbsp;<i class="fas fa-chevron-down text-color-mount2 pl-1"></i>--}}
{{--                    </button>--}}
{{--                    <div class="dropdown-menu">--}}
{{--                        <a class="dropdown-item" href="#">IN</a>--}}
{{--                        <a class="dropdown-item" href="#">OUT</a>--}}
{{--                        <a class="dropdown-item" href="#">ALL</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
{{--            <div class="my-auto mr-5">--}}
{{--                <button type="button" class="btn btn-nb-mount mr-4 p-0 fontsize-mount"><a class="w-100 h-100 text-white text-decoration-none px-4 py-2" href="{{url('sale_create')}}">add</a></button>--}}
{{--                <button type="button" class="btn btn-nb-mount px-3 fontsize-mount fontsize-mount" data-toggle="modal" data-target="#Transfer">Transfer</button>--}}
{{--            </div>--}}
        </div>
        <div class="pt-4">
            <div class="mb-2">
                <p class="mb-3 fontsize-mount17 ml-1 d-inline">Total amount exchange :</p>
                <p class="fontsize-mount17 d-inline"> 100,100,00</p>
            </div>
            <table class="table bg-white box-shadow-mount rounded-table-mount mt-1"  id="myTable" >
                <thead>
                <tr>
                    <th scope="col" class=" border-top-0 fontsize-mount6" >Currency</th>
                    <th scope="col" class=" border-top-0 fontsize-mount6">Amount</th>
                    <th scope="col" class=" border-top-0 fontsize-mount6">Exchanged</th>
                    <th scope="col" class=" border-top-0 fontsize-mount6">Amount</th>
                    <th scope="col" class=" border-top-0 fontsize-mount6">Date & Time</th>
                    <th scope="col" class=" border-top-0 fontsize-mount6">Sale Representative</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td scope="row" class="table-row-m fontsize-mount2 border-top-0">Myanmar Kyats</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">1000000</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">Japanese Yen</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">1000000</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">1:30 PM</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">Khant</td>
                </tr>
                <tr>
                    <td scope="row" class="table-row-m fontsize-mount2 border-top-0">U.S Dollar</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">1000000</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">Singapore Sing</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">1000000</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">2:30 PM</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">Will Smith</td>
                </tr>
                <tr>
                    <td scope="row" class="table-row-m fontsize-mount2 border-top-0">Singapore Sing</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">1000000</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">Myanmar Kyats</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">1000000</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">3:30 PM</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">The Rock</td>
                </tr>
                <tr>
                    <td scope="row" class="table-row-m fontsize-mount2 border-top-0">Thai Baht</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">1000000</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">Singapore Sing</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">1000000</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">4:30 PM</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">Van Desel</td>
                </tr>
                <tr>
                    <td scope="row" class="table-row-m fontsize-mount2 border-top-0">Japanese Yen</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">1000000</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">Myanmar Kyats</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">1000000</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">5:30 PM</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">Paul Walker</td>
                </tr>
                <tr>
                    <td scope="row" class="table-row-m fontsize-mount2 border-top-0">Chinese Yuan</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">1000000</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">Japanese Yuan</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">1000000</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">12:30 PM</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">Simon</td>
                </tr>
                </tbody>
            </table>
        </div>
{{--        <button id="fk">s</button>--}}
    </div>
<script>
    $(function(){
        $("#sr a").addClass("active-sr");

        $("#sr").addClass("active2");

    });
</script>
    @endsection
