@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
{{--        <div class="d-flex justify-content-between top-box-mount shadow-sm">--}}
{{--            <div  class="my-auto ml-4 pl-3">--}}
{{--                <select class="selectpicker " name="Branches" data-style="btn-white" data-width="auto">--}}
{{--                    <option selected disabled>Member Roles</option>--}}
{{--                    <option>1111</option>--}}
{{--                    <option>22222</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="pt-2 mt-1">
{{--            <div class="mb-1">--}}
{{--                <p class="mb-3 fontsize-mount17 ml-1 d-inline text-shadow-mount">Total amount exchange :</p>--}}
{{--                <p class="fontsize-mount17 d-inline text-shadow-mount"> 100,100,00</p>--}}
{{--            </div>  --}}
            <table class="table bg-white box-shadow-mount rounded-table-mount mt-1"  id="myTable" >
                <thead>
                <tr>
                    <th scope="col" class=" border-top-0 fontsize-mount6" >Currency</th>
                    <th scope="col" class=" border-top-0 fontsize-mount6">Amount</th>
                    <th scope="col" class=" border-top-0 fontsize-mount6">Exchanged</th>
                    <th scope="col" class=" border-top-0 fontsize-mount6">Amount</th>
                    <th scope="col" class=" border-top-0 fontsize-mount6">Changes</th>
                    <th scope="col" class=" border-top-0 fontsize-mount6">Date & Time</th>
                    <th scope="col" class=" border-top-0 fontsize-mount6">Sale Representative</th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td scope="row" class="table-row-m fontsize-mount2 border-top-0">{{$transaction->in_currency}}</td>
                        <td class="table-row-m fontsize-mount2 border-top-0">{{$transaction->in_value_MMK}}</td>
                        <td class="table-row-m fontsize-mount2 border-top-0">{{$transaction->out_currency}}</td>
                        <td class="table-row-m fontsize-mount2 border-top-0">{{$transaction->out_value_MMK}}</td>
                        <td class="table-row-m fontsize-mount2 border-top-0">{{$transaction->changes}}</td>
                        <td class="table-row-m fontsize-mount2 border-top-0">{{$transaction->date_time}}</td>
                        <td class="table-row-m fontsize-mount2 border-top-0">{{$transaction->staff->name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
{{--        @if($transactions)--}}
            {{$transactions->links()}}
{{--        @endif--}}
    </div>
<script>
    $(function(){
        $("#sr a").addClass("active-sr");

        $("#sr").addClass("active2");

    });
</script>
    @endsection
