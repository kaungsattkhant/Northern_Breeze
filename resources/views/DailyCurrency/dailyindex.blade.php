@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
        <div class="d-flex justify-content-between top-box-mount shadow-sm">
            <div  style="margin: 20px 0 0 0" class="input-group h-25 pl-5">
                <input type="text" id="datepicker" autocomplete="off"  name="daily_datefilter" class="border-top-0 border-right-0 border-left-0 pl-5 dtpick-input" placeholder="YY-MM-DD">
                <div class="input-group-append">
                    <button class="btn btn-nb-mount-filter" id="currency_datefilter"><i class="fas fa-filter"></i></button>
                </div>

            </div>

            @if(\Illuminate\Support\Facades\Auth::user()->isAdmin() || \Illuminate\Support\Facades\Auth::user()->isManager())
                <div class="mr-5 my-auto">
                    <form action="{{url('daily_currency/create')}}" method="get">
                        <button type="submit" class="btn btn-nb-mount mr-4 p-0 fontsize-mount"><a class="w-100 h-100 text-white text-decoration-none px-4 py-2">Create</a></button>
                    </form>
                </div>
            @endif


        </div>

        <div class="pt-5">
            <table class="table bg-white box-shadow-mount rounded-table-mount "  id="myTable">
                <thead>
                <tr>

                    <th scope="col" class="border-top-0 fontsize-mount6" >Currency</th>
                    <th scope="col" class="border-top-0 fontsize-mount6" >Group</th>
                    <th scope="col" class="border-top-0 fontsize-mount6">Note</th>
                    <th scope="col" class="border-top-0 fontsize-mount6">Selling Value</th>
                    <th scope="col" class="border-top-0 fontsize-mount6">Buying Value</th>
                    <th scope="col" class="border-top-0 fontsize-mount6"></th>

                </tr>
                </thead>
                <tbody id="dailycurrency_table">

                @foreach($groups as $group)
                <tr>
                    <td scope="row" class="table-row-m fontsize-mount2 border-top-0">{{$group->currency->name}}</td>

                    <td scope="row" class="table-row-m fontsize-mount2 border-top-0">{{$group->name}}</td>
                    <td class="table-row-m fontsize-mount2 border-top-0">
                        @foreach($group->notes as $note)
                            {{$note->name}}
                            @endforeach
                    </td>
                    <td class="table-row-m text-info border-top-0">
                       {{$group->lastest_sell_value}}
                    </td>
                    <td class="table-row-m text-info border-top-0">
                        {{$group->lastest_buy_value}}
                    </td>
                    <td class="table-row-m  border-top-0"><a href="#" class="text-a-mount" onclick="dailyDetail({{$group->id}},{{$group->detail_id}})" >Detail</a></td>
                </tr>
                    @endforeach
                </tbody>
            </table>
            {{$groups->links()}}
        </div>
    </div>
{{--    <script>--}}
{{--        $(function(){--}}
{{--            $("#daily a").addClass("active-daily");--}}

{{--            $("#daily").addClass("active2");--}}

{{--        });--}}
{{--    </script>--}}
    @include('DailyCurrency.detail')
@endsection

