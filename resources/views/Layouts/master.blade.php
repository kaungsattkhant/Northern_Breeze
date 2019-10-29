<!DOCTYPE html>
<html>
<head>
    <title>Northern Breeze</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='http://fonts.googleapis.com/css?family=Merienda+One' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.css">
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">--}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/ui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/multiselect.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/multiselect-filter.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <script src="{{asset('js/jquery.js')}}"></script>
</head>
<body>
<div>
    <div class="overall-container-mount3">
        @include('Layouts.sidebar')
        @yield('content')
    </div>
</div>
{{-- @include('sidebar');--}}
{{--<script src="https://code.jquery.com/jquery-3.4.1.js"></script>--}}
{{--<<<<<<< HEAD--}}
{{--<script src="{{asset('js/jquery.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.min.js')}}"></script>--}}
{{--<link rel="stylesheet" type="text/css" href="{{asset('js/datepicker.min.js')}}">--}}

{{--=======--}}
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}


<script src="{{asset('js/bt.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/multiselect.js')}}"></script>
<script src="{{asset('js/multiselectfilter.js')}}"></script>
{{--<script src="{{asset('js/multiselectde.js')}}"></script>--}}

{{--<script src="{{asset('js/bootstrap.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.popper.min.js')}}"></script>--}}
{{--<script href="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" type="text/javascript"></script>--}}
{{--<script href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" type="text/javascript"></script>"--}}
@yield('script')
<script src="{{asset('js/tablefilter.js')}}"></script>
<script src="{{asset('js/multi.js')}}"></script>


<script>
    $(function() {
        // $("select").multiselect();
        $('#menu').hover(function() {
                $('.img-pos').addClass('active-pos');
            }, function() {
                // on mouseout, reset the background colour
                $('.img-pos').removeClass('active-pos');
            }
        );
    });
</script>

</body>
</html>
