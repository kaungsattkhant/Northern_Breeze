@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
        <form action="{{url('daily_currency/store')}}" method="post">
            @csrf
        <div class="d-flex justify-content-between top-box-mount box-shadow-mount2">
            <div  class="my-auto btnzz ml-4">
                <label class="text-color-mount">Daily Currency</label>
                {{--                <input type="text" name="name" placeholder="Name..." class="fontsize-mount2 border-0 ml-5 pl-2 input-name">--}}
            </div>
            <button type="submit" class="btn btn-nb-mount px-4 my-auto mr-5 fontsize-mount2"  > Add </button>
        </div>
        <div class="pt-5">
            <div class="bg-white rounded-table-mount box-shadow-mount2 pb-5 px-2">
                <div class="mb-3 pt-3 pb-1  ">
                    <select class="border-0 rounded-0  bg-white  text-color-mount fontsize-mount18 ml-4 pl-2 btn-m" style="height: 50px;" id="daily_currency_filter">
                        <option selected disabled style="background-color: #e8e8e8;">Currency</option>
                        @php
                           $currencies=\App\Model\Currency::all();
                        @endphp
                        @foreach($currencies as $currency)
                            <option style="background-color: #f7f7f7;" value="{{$currency->id}}"
                            >{{$currency->name}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="container" id="daily">
                    <div id="group">

                    </div>
                </div>
            </div>

        </div>
        </form>
    </div>
    <script>
        $(function(){
            $("#daily a").addClass("active-daily");

            $("#daily").addClass("active2");

        });
    </script>
    <script src="{{asset('js/dailycurrency.js')}}"></script>


@endsection


