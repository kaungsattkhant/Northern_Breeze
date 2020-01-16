@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
        @if(session()->has('error'))
            <div class="alert alert-danger" style="width:700px">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session()->get('error') }}
            </div>
        @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
{{--        @if(Session::has('error'))--}}
{{--            <div class="alert alert-danger"><span class="glyphicon glyphicon-ok"></span><em> {!! session('error') !!}</em></div>--}}
{{--        @endif--}}

            @if(session()->has('success'))
                <div class="alert alert-success" style="width:700px">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ session()->get('success') }}
                </div>
            @endif

        <div class="">
            <form action="{{url('daily_currency/store')}}" method="post">
                @csrf
            <div class="border-bottom-radius-mount ">
                <div class="mb-0 pt-4 pb-4 px-2 d-flex justify-content-between fs-select bg-white border-bottom-radius-mount box-shadow-mount2">
                    <select  class="selectpicker ml-4 pl-2 " name="currency" data-width="auto" id="daily_currency_filter">
                        <option selected disabled style="background-color: #e8e8e8;">Currency</option>
                        @php
                            $currencies=\App\Model\Currency::all();
                        @endphp
                        @foreach($currencies as $currency)
                            <option value="{{$currency->id}}">{{$currency->name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-nb-mount px-4 my-auto mr-5 fontsize-mount2" id="create_button"> Add </button>
                </div>
                <div class="container bg-white rounded-table-mount box-shadow-mount pr-4" id="daily" style="margin-top: 2.3rem">
                    <div id="group" class="">

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


