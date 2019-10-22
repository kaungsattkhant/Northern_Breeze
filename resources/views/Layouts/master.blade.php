<!DOCTYPE html>
<html>
<head>
    <title>Northern Breeze</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='http://fonts.googleapis.com/css?family=Merienda+One' rel='stylesheet' type='text/css'>
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">--}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
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
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}


<script src="{{asset('js/bootstrap.js')}}"></script>
{{--<script src="{{asset('js/bootstrap.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.popper.min.js')}}"></script>--}}
{{--<script href="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" type="text/javascript"></script>--}}
{{--<script href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" type="text/javascript"></script>"--}}
@yield('script')


<script>
    $(function() {
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
