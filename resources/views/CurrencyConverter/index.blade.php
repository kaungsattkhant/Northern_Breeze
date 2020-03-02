<!DOCTYPE html>
<html lang="en">
<head>
    <title>Currency Converter</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=yes">
    {{--    <link rel="stylesheet" type="text/css" href="/home/single/Desktop/design/fontawesome/css/all.css">--}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
    {{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">--}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>--}}
    {{--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>--}}
    {{--    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>--}}
</head>
<body>
<div class="container-mount mount-bg">
    {{--    <img src="img/123asdf.jpg" class="img-bg-login">--}}
    <div class="mount-login-box shadow-lg p-3 mb-5">
        <form action="{{url('currency_converter/convert_amount')}}" method="post">
            @csrf
            <div>
                <img src="../image/nb.jpg" style="border-radius: 50%;width: 65px;height: 65px;" class="d-flex mx-auto">
            </div>
            <div class="pt-1">
                <label for="Username" class="mount-label">From Exchange</label>
                <select  class="selectpicker" name="from_exchange" title="roles" data-style="btn-white" data-width="auto" id="staff_filter">
                    <option selected disabled>Choose Currency</option>
                    @php
                        $currency=\App\Model\Currency::all();
                    @endphp
                    @foreach($currency as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="pt-1">
                <label for="Username" class="mount-label">To Exchange</label>
                <select  class="selectpicker" name="to_exchange" title="roles" data-style="btn-white" data-width="auto" id="staff_filter">
                    <option selected disabled>choose currency</option>
                    @php
                        $currency=\App\Model\Currency::all();
                    @endphp
                    @foreach($currency as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="pt-2">
                <label for="amount" class="mount-label">Amount</label>
                <input type="number" class="form-control " name="amount"  placeholder="Enter amount">
            </div>
            <div class="d-flex  pt-4 mt-1">
                <button type="submit" class="mount-login-button" >Calculate</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
