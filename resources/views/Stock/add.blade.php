@extends('Layouts.master')
@section('content')

        <div class="container-nb-mount">
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="col-md-10 alert alert-danger" style="height:40px;margin:0;list-style:none;">
                            {{ $error }}</li>
                    @endforeach
                </ul>
            @endif
{{--                <form id="stockForm">--}}
                    <form action="{{url('stock/store')}}" method="post"  >
                @csrf
            <div class="d-flex justify-content-between top-box-mount shadow-sm">
                                <div class="my-auto">
                                    <p style="margin-left: 20px"><b>Total values:</b><i> {{$branch_total_value}}MMKs</i></p>
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
                // var values = $("input[name^='notes[]']")
                //     .map(function(){return $(this).val();}).get();
                // alert(values);

                // console.log('note_value='+'');

                // $('.note_class').focusout(function () {
                //     alert('ss');
                //     cosole.log('success');
                // });




                // $('#stockForm').validate({
                //     rules:{
                //         notes:{
                //             required:true,
                //         },
                //     },
                //     message:{
                //         notes:"Required Field",
                //     }
                // })

            });

            // function stockValidation($note) {
            //     element="input[name='notes[]']";
            //
            //     myObj={};
            //     $(element).each(myObj ,function(k,v) {
            //         note=$(this).val();
            //         if($.isNumeric(note))
            //         {
            //             $('span[class="note_error[]').each(function (k1,v1) {
            //                 // if(k1 == k)
            //                 // {
            //                 //     $('span[class="note_error[]"]').html(' numeric');
            //                 //
            //                 // }
            //             });
            //             // console.log(k);
            //             // $('span[class="note_error[]').each(function () {
            //             //     $('span[class="note_error[]"]').html(' numeric');
            //
            //             // });
            //
            //
            //         }
            //         else if(isNaN(note))
            //         {
            //             $('span[class="note_error[]"]').html('No numeric');
            //             // console.log('index is not numeric');
            //
            //         }
            //     });
            //
            // }
        </script>


@endsection
