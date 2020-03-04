<!DOCTYPE html>
<html lang="en">
<head>
    <title>Northern Breeze</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link href='http://fonts.googleapis.com/css?family=Merienda+One' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="{{asset('css/ui.css')}}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/multiselect.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/multiselect-filter.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/selectboot.css')}}">
</head>
<body>
<div>
    <div id="app" class="overall-container-mount3">
        @include('Layouts.sidebar')
        @yield('content')
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js" ></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.js"></script>
<script src="{{asset('js/tablefilter.js')}}"></script>
<script src="{{asset('js/dailycurrency.js')}}"></script>
<script src="{{asset('js/pos.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.12/js/bootstrap-select.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>


<script src="{{ asset('js/app.js') . '?' .rand(0,99999) }}" defer></script>

@yield('script')
<script src="{{asset('js/transfer.js')}}"></script>

<script>
    $(function() {
        // alert('aa');
        $('.selectpicker').selectpicker();
        $("#groupSubmit").attr("disabled", true);
        $('.currency_group').on('change',function () {
            $("#groupSubmit").attr("disabled", false);
        });
        $("#groupSubmit ").click(function () {
                   $("#groupSubmit").attr("disabled", true);
                   $('#currency_group_form').submit();
               });
        // $("select").multiselect();
        $('#menu').hover(function() {
                $('.img-pos').addClass('active-pos');
            }, function() {
                // on mouseout, reset the background colour
                $('.img-pos').removeClass('active-pos');
            }
        );
        // $('#datepicker').datepicker();
        $('#datepicker').   datepicker({
            // altFormat:"dd-mm-YY",
            dateFormat:'yy-mm-dd',
            changeYear:true,
            changeMonth:true,
            // showButtonPanel: true,
            autoSize: true,
            hideIfNoPrevNext: true,
            yearRange: "1960:2030",
            duration:'slow',
        });

    });

</script>


</body>
</html>

