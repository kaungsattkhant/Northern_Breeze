@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
        <div class="d-flex justify-content-between top-box-mount shadow-sm">


            <div  style="margin: 20px 0 0 0" class="input-group h-25 pl-5">
                <input type="text" id="currency_date" autocomplete="off"  name="daily_datefilter" class="border-top-0 border-right-0 border-left-0 pl-5 dtpick-input" placeholder="YY-MM-DD">
                <div class="input-group-append">
                    <button class="btn btn-nb-mount-filter" id="currency_datefilter"><i class="fas fa-filter"></i></button>
                </div>

            </div>
{{--            <div class="input-group mb-3 w-25">--}}
{{--                <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">--}}
{{--                <div class="input-group-append">--}}
{{--                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="mr-5 my-auto">
                <form action="{{url('daily_currency/create')}}" method="get">
                    <button type="submit" class="btn btn-nb-mount mr-4 p-0 fontsize-mount"><a class="w-100 h-100 text-white text-decoration-none px-4 py-2">Create</a></button>

                </form>
{{--                <button type="button" class="btn btn-nb-mount p-0 fontsize-mount"><a class="w-100 h-100 text-white text-decoration-none px-3 py-2" href="{{url('transfer_stock')}}">Transfer</a></button>--}}
            </div>

        </div>

        <div class="pt-5">
    {{--            @if(session()->has('error'))--}}
    {{--                <div class="alert alert-danger" style="width:700px">--}}
    {{--                    <button type="button" class="close" data-dismiss="alert">×</button>--}}
    {{--                    {{ session()->get('error') }}--}}
    {{--                </div>--}}
    {{--            @endif--}}

            <table class="table bg-white box-shadow-mount rounded-table-mount "  id="myTable">
                <thead>
                <tr>

                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6" >Currency</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6" >Group</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Note</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Selling Value</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Buying Value</th>

                </tr>
                </thead>
                <tbody id="dailycurrency_table">

                @foreach($groups as $group)
                <tr>
                    <td scope="row" class="table-row-m fontsize-mount2">{{$group->currency->name}}</td>

                    <td scope="row" class="table-row-m fontsize-mount2">{{$group->name}}</td>
                    <td class="table-row-m fontsize-mount2">
                        @foreach($group->notes as $note)
                            {{$note->name}}
                            @endforeach
                    </td>

                    <td class="table-row-m text-info">
                       {{$group->lastest_sell_value}}
                    </td>
                    <td class="table-row-m text-info">
                        {{$group->lastest_buy_value}}
                    </td>
                    <td class="table-row-m "><a href="#" class="text-a-mount" onclick="dailyDetail({{$group->id}},{{$group->detail_id}})" >Detail</a></td>
                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(function(){
            $("#daily a").addClass("active-daily");

            $("#daily").addClass("active2");

        });
    </script>


    @include('DailyCurrency.detail')
@endsection
