<!DOCTYPE html>
<html>
<head>
    <title>Northern Breeze</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='http://fonts.googleapis.com/css?family=Merienda+One' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">


</head>
<body>

<div class="overall-container-mount">
    @include('Layouts.sidebar')
    @yield('content')
</div>

{{-- @include('sidebar');--}}
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/8f623ae71b.js"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
@yield('script')
<script>
    // Add active class to the current button (highlight it)
    var header = document.getElementById("myDIV");
    var btns = header.getElementsByClassName("btn-mount");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }



</script>
</body>
</html>
