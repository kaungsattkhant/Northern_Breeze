@extends('Layouts.master')
@section('content')

        <div class="container-nb-mount">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{url('stock/store')}}" method="post">
                @csrf
            <div class="d-flex justify-content-between top-box-mount shadow-sm">
                                <div class="my-auto">
                                    <p style="margin-left: 20px"><b>Total values:</b> $823,323,000</p>
                                </div>
                <button type="submit" class="btn btn-nb-mount-save fontsize-mount px-4 stock_create" >Add</button>
            </div>
            <select class="selectpicker pl-2" name="currency" data-style="btn-white" data-width="auto" data-live-search="true" id="stock_currency_filter">
                <option  disabled selected>Choose Currency Type</option>
                @php
                    $currencies=\App\Model\Currency::all();
                @endphp
                @foreach($currencies as $currency)
                    <option value="{{$currency->id}}"
                    >{{$currency->name}}</option>
                @endforeach
            </select>
            <div class="row" id="stock_table_filter">



            </div>
            </form>

        </div>

@include('Stock.save')

        <script>
            $(function(){
                $("#stock a").addClass("active-si");

                $("#stock").addClass("active2");
                $('.stock_create').hide();
                // $('#to_branch').hide();
                $('#stock_currency_filter').on('change',function ( ) {
                   $('.stock_create').fadeIn();
                   // $('#to_branch').fadeIn();
                });
            });
        </script>

@endsection
