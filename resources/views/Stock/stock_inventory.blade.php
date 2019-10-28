@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
        <div class="d-flex justify-content-between top-box-mount shadow-sm">
            <div  class="my-auto btnzz ml-4">
                <select class="border-0 rounded-0  bg-white  text-color-mount fontsize-mount22 pl-4 btn-m" style="height: 50px;">
                    <option selected disabled>Branches</option>
                    <option>1111</option>
                    <option>22222</option>
                </select>

                <select class="border-0 rounded-0  bg-white  text-color-mount fontsize-mount22 pl-4 btn-m" style="height: 50px;">
                    <option selected disabled>In/Out/All</option>
                    <option>1111</option>
                    <option>22222</option>
                </select>
            </div>
            <div class="mr-5 my-auto">
                <button type="button" class="btn btn-nb-mount mr-4 p-0 fontsize-mount"><a class="w-100 h-100 text-white text-decoration-none px-4 py-2" href="{{url('create_stock')}}">Add</a></button>

                 <button type="button" class="btn btn-nb-mount p-0 fontsize-mount"><a class="w-100 h-100 text-white text-decoration-none px-3 py-2" href="{{url('transfer_stock')}}">Transfer</a></button>
             </div>

         </div>
         <div class="pt-5">
             <div class="mb-2">
                 <p class="mb-3 fontsize-mount17 ml-1 d-inline">Total amount exchange :</p>
                 <p class="fontsize-mount17 d-inline"> 100,100,00</p>
             </div>
             <table class="table bg-white box-shadow-mount rounded-table-mount "  id="myTable">
                 <thead>
                 <tr>
                     <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6" >Currency</th>
                     <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Amount</th>
                     <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">In/Out</th>
                     <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6"></th>
                 </tr>
                 </thead>
                 <tbody>
                 <tr>
                     <td scope="row" class="table-row-m fontsize-mount2">Myanmar Kyats</td>
                     <td class="table-row-m fontsize-mount2">1000000</td>
                     <td class="table-row-m text-info">In</td>
                     <td class="table-row-m "><a href="#" class="text-a-mount" data-toggle="modal" data-target="#detail">Detail</a></td>
                 </tr>
                 <tr>
                     <td scope="row" class="table-row-m fontsize-mount2">U.S Dollar</td>
                     <td class="table-row-m fontsize-mount2">1000000</td>
                     <td class="table-row-m text-danger">OUt</td>
                     <td class="table-row-m "><a href="#" class="text-a-mount" data-toggle="modal" data-target="#detail">Detail</a></td>
                 </tr>
                 <tr>
                     <td scope="row" class="table-row-m fontsize-mount2">Singapore Sing</td>
                     <td class="table-row-m fontsize-mount2">1000000</td>
                     <td class="table-row-m text-info">In</td>
                     <td class="table-row-m "><a href="#" class="text-a-mount" data-toggle="modal" data-target="#detail">Detail</a></td>
                 </tr>
                 <tr>
                     <td scope="row" class="table-row-m fontsize-mount2">Thai Baht</td>
                     <td class="table-row-m fontsize-mount2">1000000</td>
                     <td class="table-row-m text-info">In</td>
                     <td class="table-row-m "><a href="#" class="text-a-mount" data-toggle="modal" data-target="#detail">Detail</a></td>
                 </tr>
                 <tr>
                     <td scope="row" class="table-row-m fontsize-mount2">Japanese Yen</td>
                     <td class="table-row-m fontsize-mount2">1000000</td>
                     <td class="table-row-m text-danger">Out</td>
                     <td class="table-row-m "><a href="#" class="text-a-mount" data-toggle="modal" data-target="#detail">Detail</a></td>
                 </tr>
                 <tr>
                     <td scope="row" class="table-row-m fontsize-mount2">Chinese Yuan</td>
                     <td class="table-row-m fontsize-mount2">1000000</td>
                     <td class="table-row-m text-info">In</td>
                     <td class="table-row-m "><a href="#" class="text-a-mount" data-toggle="modal" data-target="#detail">Detail</a></td>
                 </tr>
                 </tbody>
             </table>
         </div>
     </div>
    <script>
        $(function(){
            $("#stock a").addClass("active-si");

            $("#stock").addClass("active2");

        });
    </script>

    @include('Stock.detail_stock')
     @endsection

