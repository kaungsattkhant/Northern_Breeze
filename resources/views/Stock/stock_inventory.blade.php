@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
        <div class="d-flex justify-content-between top-box-mount shadow-sm">
            <div  class="my-auto ml-4 pl-3">
                <select class="selectpicker show-menu-arrow" name="Branches" data-style="btn-white" data-width="auto">
                    <option selected disabled>Branches</option>
                    <option>1111</option>
                    <option>22222</option>
                </select>

                <select class="selectpicker show-menu-arrow" name="Branches" data-style="btn-white" data-width="auto">
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
         <div class="pt-2 mt-1">
             <div class="mb-1 pb-">
                 <p class="mb-3 fontsize-mount17 ml-1 d-inline">Total amount exchange :</p>
                 <p class="fontsize-mount17 d-inline"> 100,100,00</p>
             </div>
             <table class="table bg-white box-shadow-mount rounded-table-mount "  id="myTable">
                 <thead>
                 <tr>
                     <th scope="col" class="border-top-0 fontsize-mount6" >Currency</th>
                     <th scope="col" class=" border-top-0 fontsize-mount6">Amount</th>
                     <th scope="col" class="border-top-0 fontsize-mount6">In/Out</th>
                     <th scope="col" class=" border-top-0 fontsize-mount6"></th>
                 </tr>
                 </thead>
                 <tbody>
                 <tr>
                     <td scope="row" class="table-row-m fontsize-mount2 border-top-0">Myanmar Kyats</td>
                     <td class="table-row-m fontsize-mount2 border-top-0">1000000</td>
                     <td class="table-row-m text-info border-top-0">In</td>
                     <td class="table-row-m border-top-0"><a href="#" class="text-a-mount" data-toggle="modal" data-target="#detail">Detail</a></td>
                 </tr>
                 <tr>
                     <td scope="row" class="table-row-m fontsize-mount2 border-top-0 ">U.S Dollar</td>
                     <td class="table-row-m fontsize-mount2 border-top-0">1000000</td>
                     <td class="table-row-m text-danger border-top-0">Out</td>
                     <td class="table-row-m border-top-0"><a href="#" class="text-a-mount" data-toggle="modal" data-target="#detail">Detail</a></td>
                 </tr>
                 <tr>
                     <td scope="row" class="table-row-m fontsize-mount2 border-top-0">Singapore Sing</td>
                     <td class="table-row-m fontsize-mount2 border-top-0">1000000</td>
                     <td class="table-row-m text-info border-top-0">In</td>
                     <td class="table-row-m border-top-0"><a href="#" class="text-a-mount" data-toggle="modal" data-target="#detail">Detail</a></td>
                 </tr>
                 <tr>
                     <td scope="row" class="table-row-m fontsize-mount2 border-top-0">Thai Baht</td>
                     <td class="table-row-m fontsize-mount2 border-top-0">1000000</td>
                     <td class="table-row-m text-info border-top-0">In</td>
                     <td class="table-row-m  border-top-0"><a href="#" class="text-a-mount" data-toggle="modal" data-target="#detail">Detail</a></td>
                 </tr>
                 <tr>
                     <td scope="row" class="table-row-m fontsize-mount2 border-top-0">Japanese Yen</td>
                     <td class="table-row-m fontsize-mount2 border-top-0">1000000</td>
                     <td class="table-row-m text-danger border-top-0">Out</td>
                     <td class="table-row-m  border-top-0"><a href="#" class="text-a-mount" data-toggle="modal" data-target="#detail">Detail</a></td>
                 </tr>
                 <tr>
                     <td scope="row" class="table-row-m fontsize-mount2 border-top-0">Chinese Yuan</td>
                     <td class="table-row-m fontsize-mount2 border-top-0">1000000</td>
                     <td class="table-row-m text-info border-top-0">In</td>
                     <td class="table-row-m  border-top-0"><a href="#" class="text-a-mount" data-toggle="modal" data-target="#detail">Detail</a></td>
                 </tr>
                 <tr>
                     <td scope="row" class="table-row-m fontsize-mount2 border-top-0"></td>
                     <td class="table-row-m fontsize-mount2 border-top-0"></td>
                     <td class="table-row-m text-info border-top-0"></td>
                     <td class="table-row-m  border-top-0"><a href="#" class="text-a-mount" data-toggle="modal" data-target="#detail"></a></td>
                 </tr>
                 <tr>
                     <td scope="row" class="table-row-m fontsize-mount2 border-top-0">.</td>
                     <td class="table-row-m fontsize-mount2 border-top-0">.</td>
                     <td class="table-row-m text-info border-top-0">.</td>
                     <td class="table-row-m  border-top-0"><a href="#" class="text-a-mount" data-toggle="modal" data-target="#detail"></a></td>
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

