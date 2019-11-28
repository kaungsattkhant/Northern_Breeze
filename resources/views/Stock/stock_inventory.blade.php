@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">

        <div class="row top-box-mount shadow-sm">
            <div  class="my-auto  col-5">
                <select class="selectpicker " name="Branches" data-style="btn-white" data-width="auto" id="branch">
                    <option selected disabled>Branches</option>
                    @php
                        $branches=\App\Model\Branch::all();
                    @endphp
                    @foreach($branches as $branch)
                        <option value="{{$branch->id}}" >{{$branch->name}}</option>
                    @endforeach
                </select>

                <select id="transfer_status_filter" class="selectpicker"  name="In/Out/All" data-style="btn-white" data-width="auto">
                    <option selected disabled>In/Out/All</option>
                    <option value="1">In</option>
                    <option value="2">Out</option>
                    <option value="3">Add</option>
                    <option value="4" >All</option>
                </select>
            </div>
{{--<<<<<<< HEAD--}}
{{--            <div  style="margin: 20px 0 0 0" class="input-group h-25 pl-5">--}}
{{--                <input type="text" id="datepicker" autocomplete="off"  name="transfer_history_filter" class="border-top-0 border-right-0 border-left-0 pl-5 dtpick-input" placeholder="YY-MM-DD">--}}
{{--=======--}}
            <div  style="margin: 20px 0 0 0" class="input-group h-25  col-4">
                <input type="text" id="datepicker" autocomplete="off"  name="transfer_history_filter" class="border-top-0 border-right-0 border-left-0 pl-5 dtpick-input2" placeholder="YY-MM-DD">
{{-->>>>>>> origin/front_end-1.1--}}
                <div class="input-group-append">
                    <button class="btn btn-nb-mount-filter" id="transfer_datefilter"><i class="fas fa-filter"></i></button>
                </div>

            </div>
            <div class="pr-0 mr-0 my-auto col-3">
                <form class="d-inline" action="{{url('stock/create_stock')}}" method="get">
                    <button type="submit" class="btn btn-nb-mount mr-4 p-0 fontsize-mount"><a class="w-100 h-100 text-white text-decoration-none px-4 py-2" >Add</a></button>

                </form>
                <form class="d-inline" action="{{url('stock/transfer')}}" method="get">
                    <button type="submit" class="btn btn-nb-mount p-0 fontsize-mount"><a class="w-100 h-100 text-white text-decoration-none px-3 py-2" >Transfer</a></button>

                </form>

            </div>

        </div>
         <div class="pt-2 mt-1">
             <div class="mb-1 pb-">
                 <p class="mb-3 fontsize-mount17 ml-1 d-inline text-shadow-mount">Total amount exchange :</p>
{{--                 <p class="fontsize-mount17 d-inline text-shadow-mount"> {{$transfer_total_value}}</p>--}}

             </div>
             @if ($errors->any())
{{--                 <div class="alert alert-danger">--}}
                     <ul>
                         @foreach ($errors->all() as $error)
                             <li class="col-md-10 alert alert-danger" style="height:40px;list-style:none;">
                                 {{ $error }}</li>
                         @endforeach
                     </ul>
{{--                 </div>--}}
             @endif

             @if(session()->has('error'))
                     <ul>
                         <li class="col-md-10 alert alert-danger" style="height:40px;list-style:none;">
                             {{ session()->get('error') }}
                         </li>
                     </ul>
             @endif
             <table class="table bg-white box-shadow-mount rounded-table-mount "  >
                 <thead>
                 <tr>
                     <th scope="col" class="border-top-0 fontsize-mount6" >Currency</th>
                     <th scope="col" class=" border-top-0 fontsize-mount6">Amount</th>
                     <th scope="col" class="border-top-0 fontsize-mount6">In/Out</th>
                     <th scope="col" class=" border-top-0 fontsize-mount6"></th>
                 </tr>
                 </thead>
                 <tbody id="stock_transfer">
{{--                 @include('Stock.stock_admin_view')--}}
{{--                 @include('Stock.stock_manager_and_front_view')--}}
{{--                 @foreach($total_transfers as $transfers)--}}
                         @foreach($transfers as $transfer)
                             <tr>
                                 <td scope="row" class="table-row-m fontsize-mount2 border-top-0">{{$transfer->currency->name}}</td>
                                 <td class="table-row-m fontsize-mount2 border-top-0">{{$transfer->total_transfer_value}}</td>
                                 <td class="table-row-m text-info border-top-0">{{$transfer->transfer_status}}</td>
                                 <td class="table-row-m border-top-0"><a href="#" class="text-a-mount" onclick="transfer_detail({{$transfer->id}})">Detail</a></td>
{{--                                 <td class="table-row-m brder-top-0"><a href="#" class="text-a-mount" data-target="#detail" data-toggle="modal">Detail</a></td>--}}
                             </tr>
                         @endforeach
{{--                 @endforeach--}}
                 </tbody>
             </table>
             {{$transfers->links()}}
         </div>
    </div>
{{--    </div>--}}
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

