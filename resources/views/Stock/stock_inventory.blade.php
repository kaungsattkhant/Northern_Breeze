@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
        <div class="d-flex justify-content-between top-box-mount shadow-sm">
            <div  class="my-auto ml-4 pl-3">
                <select class="selectpicker" name="Branches" data-style="btn-white" data-width="auto">
                    <option selected disabled>Branches</option>
                    @foreach($branches as $branch)
                        <option value="{{$branch->id}}" >{{$branch->name}}</option>
                    @endforeach
                </select>
                <select class="selectpicker" name="In/Out/All" data-style="btn-white" data-width="auto">
                    <option selected disabled>In/Out/All</option>
                    <option>1111</option>
                    <option>22222</option>
                </select>
            </div>

            <div class="mr-5 my-auto">
                <form action="{{url('stock/create_stock')}}" method="get">
                    <button type="submit" class="btn btn-nb-mount mr-4 p-0 fontsize-mount"><a class="w-100 h-100 text-white text-decoration-none px-4 py-2">Add</a></button>
                </form>
                <form action="{{url('stock/transfer')}}" method="get">
                    <button type="submit" class="btn btn-nb-mount p-0 fontsize-mount"><a class="w-100 h-100 text-white text-decoration-none px-4 py-2">Transfer</a></button>
                </form>
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
                 @foreach($transfers as $transfer)
                     <tr>
                         <td scope="row" class="table-row-m fontsize-mount2 border-top-0">{{$transfer->currency->name}}</td>
                         <td class="table-row-m fontsize-mount2 border-top-0">{{$transfer->total_transfer_value}}</td>
                         <td class="table-row-m text-info border-top-0">{{$transfer->transfer_status}}</td>
                         <td class="table-row-m border-top-0"><a href="#" class="text-a-mount" onclick="transfer_detail({{$transfer->id}})">Detail</a></td>
{{--                         <td class="table-row-m border-top-0"><a href="#" class="text-a-mount" data-target="#detail" data-toggle="modal">Detail</a></td>--}}
                     </tr>
                 @endforeach

                 </tbody>
             </table>
             {{$transfers->links()}}
         </div>
     </div>
    <script>
        $(function(){
            $("#stock a").addClass("active-si");

            $("#stock").addClass("active2");

        });
    </script>
    <script src="{{asset('js/transfer.js')}}">
    </script>

    @include('Stock.detail_stock')
     @endsection

