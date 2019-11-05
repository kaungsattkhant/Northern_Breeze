@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
        @if(session()->has('error'))
            <div class="alert alert-danger" style="width:700px">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session()->get('error') }}
            </div>
        @endif

        <div class="">
            <form action="{{url('daily_currency/store')}}" method="post">
                @csrf
            <div class="bg-white border-bottom-radius-mount box-shadow-mount2 pb-5 px-2 pt-4">
                <div class="mb-5 pt-3 pb-1 d-flex justify-content-between fs-select">
                    <select  class="selectpicker ml-4 pl-2" name="currency" data-width="auto" id="daily_currency_filter">
                        <option selected disabled style="background-color: #e8e8e8;">Currency</option>
                        @php
                            $currencies=\App\Model\Currency::all();
                        @endphp
                        @foreach($currencies as $currency)
                            <option value="{{$currency->id}}">{{$currency->name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-nb-mount px-4 my-auto mr-5 fontsize-mount2"  data-toggle="modal" data-target="#create"> Add </button>
                </div>
                <div class="container" id="daily">
                    <div id="group">

                    </div>

                </div>
            </div>
        </form>


    </div>
    </div>
    <script>
        $(function(){
            $("#daily a").addClass("active-daily");

            $("#daily").addClass("active2");

        });
    </script>
{{--    <script src="{{asset('js/dailycurrency.js')}}"></script>--}}


@endsection


