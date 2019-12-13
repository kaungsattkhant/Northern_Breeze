<!DOCTYPE html>
<html>
<head>
    <title>testtteesstt</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

    <style type="text/css">
        img{
            /*position: absolute;*/
            voice-family: male;
            voice-duration: 5s;
            /*clear: both;*/
        }

        .asdf{
            /*mask-image: url("https://www.svgrepo.com/show/70431/carnival-mask-black-rounded-shape.svg");*/
            -webkit-mask: url("https://www.svgrepo.com/show/70431/carnival-mask-black-rounded-shape.svg");
            -webkit-mask-size: 100px 100px;
            -webkit-mask-repeat: no-repeat;
            -webkit-mask-position-x: center;
            -webkit-mask-position-y: center;
        }
        .bootstrap-select .dropdown-menu {
            border-radius: 13px !important;
            border:5px solid gray;
        }
        .yolo:hover{
            background-color: #eeeeee;
            box-shadow: -0px -0px 2px #777777 inset;
        }
        .tMargin {
            margin-top: 20px!important;
            /*bookmark-label: content('shit');*/
        }

    </style>
    <style>
        h3.category{
            background:#e7e6e6 url('https://www.w3.org/2008/site/images/category-bg-fold.png') no-repeat bottom right;
            text-shadow:1px 1px 0 #fff;
            color:#347cb0;
            padding:0 6px 0 0;
            width:100%;
            position:relative;
            margin-top:13px;
        }
        .category{
            font-size:108%;
            font-weight:normal;
            font-style:normal;
            text-transform:uppercase;
            color:#333;
        }
        h3.category .ribbon{
            background:#e7e6e6 url('https://www.w3.org/2008/site/images/category-bg.png') repeat-x bottom right;
            display:block;
            padding:8px 5px 13px 20px;
        }
    </style>

</head>
<body>

<div class="overall-container-mount">
<div class="sidebar-nb-mount shadow mr-0"style="width: 20%;">
    <ul class="nav flex-column mr-0 pt-3" id="myDIV" style="position: relative;">
        <li class="nav-item dropdown btn-mount mx-auto mb-1" data-toggle="collapse" href="#pos">
            <a class="nav-link p-0  sidebar-box-mount img-pos text-center" href="#"  role="button" aria-haspopup="true" aria-expanded="false">
                <div class=" mt-0 px-auto "><p class="sb-text">POS &nbsp; <i class="fas fa-chevron-down"></i></p></div>

            </a>
            <div class="dropdown-menu dp-mount" id="menu" style="border: 5px solid grey; border-radius: 10px;">
                <a class="dropdown-item" href="{{url('non_member')}}" >Non-Member</a>
                <a class="dropdown-item" href="{{url('pos_member')}}" >Member</a>

            </div>

        </li>
        <div class="rounded-0 collapse border-0" id="pos" style="width: 100%">
            <div class="rounded-0 border-0 py-0" style=";background-color:#eeeeee;width: 100%">
                <a class="dropdown-item pl-4 py-3" href="{{url('non_member')}}" style="box-shadow: 1px 1px 10px #666666 inset;">Non-Member</a>
                <a class="dropdown-item pl-4 py-3" href="{{url('pos_member')}}" style="box-shadow: 1px 1px 10px #555555 inset;" >Member</a>
            </div>
        </div>
        <h3 class="category tMargin">
            <span class="ribbon">
                <a href="Consortium/mission.html#principles">
                    Web for All
{{--                    <img src="/2008/site/images/header-link.gif" alt="Header link" width="13" height="13" class="header-link" />--}}
                </a>
            </span>
        </h3>
        <li class="nav-item btn-mount mx-auto " id="member">
            <a class="nav-link p-0  sidebar-box-mount img-member text-center " href="{{url('member')}}">
                <div class=" mt-0 px-auto "><p class="sb-text">Member</p></div>
            </a>
        </li>

        <li class="nav-item btn-mount mx-auto " data-toggle="collapse" href="#collapseExample" id="sr">
            <a class="nav-link p-0  sidebar-box-mount img-sale-record text-center" >
                <div class=" mt-0 px-auto "><p class="sb-text">Sale Record</p></div></a>
        </li>
        <div class="rounded-0 collapse border-0 " id="collapseExample" style="width: 100%">
            <div class="rounded-0 border-0" style="box-shadow: 0px 0px 20px #777777 inset;background-color:#fff;width: 100%">
                <a class="dropdown-item pl-4 py-2 yolo" href="{{url('non_member')}}" style="border-bottom: 1px solid #dddddd">Non-Member</a>
                <a class="dropdown-item pl-4 py-2 yolo" href="{{url('pos_member')}}" >Member</a>
            </div>
        </div>
        <li class="nav-item btn-mount mx-auto" id="stock">
            <a class="nav-link p-0  sidebar-box-mount img-stock-inventory text-center" href="{{url('stock')}}">
                <div class=" mt-0 px-auto "><p class="sb-text">Stock Inventory</p></div></a>
        </li>
        <li class="nav-item btn-mount mx-auto" id="group">
            <a class="nav-link p-0  sidebar-box-mount img-group text-center " href="{{url('currency')}}">
                <div class=" mt-0 px-auto "><p class="sb-text">Currency Group</p></div></a>
        </li>
        <li class="nav-item btn-mount mx-auto" id="daily">
            <a class="nav-link p-0  sidebar-box-mount img-daily text-center " href="{{url('daily_currency')}}">
                <div class=" mt-0 px-auto "><p class="sb-text">Daily Currency</p></div></a>
        </li>

{{--        <li class="nav-item mx-auto">--}}
{{--            <p>--}}
{{--                <a class="btn " data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">--}}
{{--                    Link--}}
{{--                </a>--}}

{{--            </p>--}}

{{--        </li>--}}
        <li class="nav-item btn-mount mx-auto" id="staff">
            <a class="nav-link p-0  sidebar-box-mount img-staff text-center " href="{{url('staff')}}">
                <div class=" mt-0 px-auto "><p class="sb-text">Staff</p></div></a>
        </li>

    </ul>

</div>
{{--    @include('Layouts.sidebar')--}}
    <div class="container-nb-mount">
        <div>
            <form action="{{url('currency_group/store')}}" method="post">
                @csrf
                {{--                <div class="d-flex justify-content-between top-box-mount rounded-0 border-0 shadow-sm">--}}
                {{--                    <div  class="my-auto btnzz ml-4">--}}

                {{--                    </div>--}}
                {{--                    <button type="submit" class="btn btn-nb-mount px-4 my-auto mr-5 fontsize-mount2"  data-toggle="modal" data-target="#create"> Add </button>--}}

                {{--                </div>--}}
                <div class="bg-white row m-0 pb-3 border-bottom-radius-mount pt-4">
                    <div class="col ml-5">
                        <label for="#currency" class="w-25 fontsize-mount d-block"> Currency</label>
                        @php
                            $currencies=\App\Model\Currency::all();
                        @endphp
                        {{--                        <select class="border-top-0 border-right-0 border-left-0 rounded-0 bg-white text-secondary bd-bottom-mount fontsize-mount22" id="currency" name="currency">--}}
                        <select class="selectpicker"  id="currency" name="currency">
                            {{--                            <option selected disabled>--None--</option>--}}

                            @foreach($currencies as $currency)
                                <option value="{{$currency->id}}">{{$currency->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <label for="#GN" class="fontsize-mount d-block">Group Name</label>
                        <input type="text" id="GN" name="group_name" class="border-top-0 border-right-0 border-left-0 rounded-0 bd-bottom-mount fontsize-mount" placeholder="">
                        {{----}}
                    </div>
                    <div class="col">
                        {{--                        <p class="w-25 pt-2 fontsize-mount d-block" style="position: absolute;left:30px">Note</p>--}}
                        <label for="" class="fontsize-mount d-block">Note</label>
                        <div class="d-block" style=";position: relative" >
                            <select id="multi_select" multiple="multiple" name="notes[]">
                                @php
                                    $notes=\App\Model\Note::all();
                                @endphp
                                @foreach($notes as $note)
                                    <option value="{{$note->id}}">{{$note->name}}</option>
                                @endforeach
                            </select>
                            {{----}}
                            {{----}}
                        </div>
                    </div>
                    <div class="col my-auto">
                        <button type="submit" class="btn btn-nb-mount px-4 my-auto  fontsize-mount2"  data-toggle="modal" data-target="#create"  style="margin-left: 120px"> Add </button>

                    </div>
                </div>

            </form>

        </div>
        <select class="selectpicker">
            <option>Mustard</option>
            <option>Ketchup</option>
            <option>Barbecue</option>
        </select>
        <select class="selectpicker" multiple>
            <option>Mustard</option>
            <option>Ketchup</option>
            <option>Barbecue</option>
        </select>

        <table class="table bg-white box-shadow-mount rounded-table-mount mt-5"  id="myTable">
            <thead>
            <tr>
                {{--                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6" >#</th>--}}
                <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6" >Name</th>
                <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6"> Role</th>
                <th scope="col" class="border-bottom-0 border-top-0 text-center fontsize-mount6">Action</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                {{--                        <td class="table-row-m fontsize-mount">1</td>--}}

                <td scope="row" class="table-row-m fontsize-mount">a</td>
                <td class="table-row-m fontsize-mount">b</td>
                <td class="table-row-m text-center">
                    <a>
                        <i class="far fa-edit mr-3 text-info"></i>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#Delete">
                        <i class="far fa-trash-alt text-danger"></i>
                    </a>
                </td>
            </tr>

            </tbody>
        </table>
        <img class="asdf" src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxMTEhUTExMWFRUWFRUVFxUXGBcZFxUVFRUWFhUYFRcYHiggGBolHRUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKDg0OGhAQGy0lHx0tLS0tLS8tKy0tLS0tLS0tLS0tLSstLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIAKIBOAMBIgACEQEDEQH/xAAbAAACAwEBAQAAAAAAAAAAAAAEBQIDBgABB//EAEUQAAEDAgIGBgYGCQQCAwAAAAEAAgMEEQUhBhIxUWFxMkGBkaGxEyIzQnLBFENSYoLRBxUWI3OSorLhNGPC0kTwRVNU/8QAGQEAAwEBAQAAAAAAAAAAAAAAAAECAwQF/8QALxEAAgIABgEDAgUEAwAAAAAAAAECEQMSITFBURNhsfAioUJxgZHxBBQyUiPB4f/aAAwDAQACEQMRAD8A3kcUzxZz+5mr4h5UooJWXDQ0jfJI93gW5d6RT4d6EetUyv3AzNjH9Trri2ZzPUc8jdHO17j3H5L18t9Hn5q7NF6KZw+qafutPzaUG+nqWuu1+v8Ad14wPGK4WTlraxmUUcwP2n3efAKpuI4oek+a3AMb5oytbE+Rept4jUXu5sbeAkkLvy8EV9KcMiJd99QEd5WIpIqh59eaqvyZbv1gmrKCpaLtMj+cjie5ryhw7BYj4sfnH4uiPSPdubGT52HivWV4cbGnn/Exv5rK1NRVZ/ualx+6Xt8S9KTidSw5xVbeAe4eJCnxRWw/M+Tfx1hBsKZ4G86nll5r1pN9bWiHxMII7bkLI0ektYMo6aR5/wByUu8NUIyPFsTJDn07QNzdU3/nuUsrvb5+o86Y5qnBx9aqI+CWNluQA+a9gqWMybK+Q7/SxvPzVEOIvlykpJRv1Xx/26yuZSQ7TFOziWf9bpquQ13ROqBkF2iUH4SD3iwVlBQTavTJ4SF48QShqhsAyDs/9xszh3bB3KlmHtflrUzuBDm+CfHX6C5/9LK6ggcbTGHiPT28CEHBRUIdaMxX3Nlbfv1rop+icTulFEDvY4j5FVv0OitcEtG9pDvDVQpr/YTg/wDX5+wUcEhIv6GN3Evufn5IWaaKEWcIWjcGF3jYBVM0WYMxPOeHQ7hq28U0pMMc0eq6Vx++9pHijMuX8/UMr4QjGlsN9WN0bOPoXHxBajaevml6FVGBwZF/ycSjJ4pG5vhLuDRCb/0oeWpnIypWtHVruH9rbDwRSfC+wtVu39y6aSVrc61reIay/ZkB5rP4gIQdZ9ZO47wHO8jZeYiKs5mmhcOq0TiB3uVFPFWk+xgt9kxAeeapRr4iZSv4yEWIxA+rNVW4RW8dYIh8j5QQyrqWjjG7+4ONkwp8F1s3Q2PWGPYB804pqAtFmt1AOu7Se92Xgm2lu/YIxk+PcyNNhMceclXMTzc0dpJJKnNV0zdmJPa7cWaw77XT3EJQfV+jibe5zmN8glTsEpn5upnNd9yzx/S4eSVOtNA2+MGhxhwOWJm38Nov3uCYw6TsZtnMtvvxjwBS/wDZqDaWTN5nVHc5qb0ODwMF7SP3WLfkEUq1Q1mvQ9bpvC82dE93Eesi/wBd0pHspuXo3/LJFM9ER7CUDf1/0m6FnwWnfnedp4ukH9yzSjwmjT6+0wcVNO4+rSTcxrM8bpgyqhaLX9HwMgcfG5Sx+jcR6M8/ZK3815DohHtdJKR954+Sp5eX7iWfhBFTjdOzbLHbiXOPcGqNNjkUpAifA48WvafEKT9G6cbC0jjn43UP1FSdbhf7Icb9zc0/o9R/X6DIxznP92RuAcAe0n5JTXUtQT6tPTAbzrHvIaEJPTwR9BrgeEDnnveV0TA766oadzoWNb4BUo1/DJcr/lFf6vnJ9nTdjpPmnNJBLYAiIZW9TXv3pbJg0zhdlRG3iYmX/tQMWG1gOVYwncImX7LgJt3pYlpwNqnAIydb0Ly7e0/MkLkor6DFHbKl4G8MjHkuS15opNLawampqA5moa933iSf6mpnAKcdFzByGu4/0/NKaPA5H7Wyx/gYPIEpnTaMPv7R/c6/eSqut2ZU3shpTyWHqxSv4kNa3xXkmJ29X0LhvLcz4MKXVmEQNFpXzO36uufEAjxSttDh4OQkB3uc7yDUqsrM0aU1EhHqvbH8bTreNvJVNZUXuanX4ejZbuAus8cPpnH1al44NErj5WRYwKRovDNIfjMzfABFLoVs0bato6eqeIje3xvZQqMSys0azdw1ifE5d6Q0uGV3VKO0zHzR0lPURDWmliHH0L3nuspqPI80i39aVBNm0w1d5LSe4J2K/Wb+9aG79Z8Y8ysc3FyXerVN5OgDB5BWSS6/SiiqDwe7yBScE9QWI0aM1lOOHFj4v+LrronROPqunH4n27jkkFPLIz/45jRv9Lq+ZVsmKF41TDLH/BmB8GoUb7HnNHJTSj/yC1vF1j3Fqk+XVbnKx3FzvyasPUQk9D01/vgk95XlPRVrc2MeR/ChN+1yHh1uJYvSNLXU1PUC3py13+27VHaSAl9Powxp/wBRNzEjnf2uIRVNJVtH7xgaNwbHc/yop0j3C5igHx2B+SKfyg0fHuXx4A0W1Z5X85CfIhez00DMpZTy9K+/drFB1M8zW+rEx3CPUd4LOT4pO52q+gJH8MfIBKnyxuUVwbD6PAG3a+R4+yyR57wHBeDSCGPKz2fE2Q9+sfmszS4O2TN1M9vIFqbQaOxNFyyXtNh3k/JDhH8TBTl+FDB+JiQXa6/wwtcfElCSYjKMmSlp+9GB5BcTSx7I2X33ue86quGMtGTYdfgHuPhchPKltH2DM3vL3E82I1A21beQYCf7VOmxqp+ridKftWY0eAumTsWkGbcO1+TmX8RdXnGJHNs6kEf8RzLdyV8ZfYK5ze4r/XVdfOmIHO//ACRDa6Zwu58kPE2Le7/Kl9OnHsxAOAd+brLpcQqyLGGNw5ByqvRBfqyMfp39CqZL90xR+dyhKyhqr/6aI8ddrTztqq5lfVNOTqdn3TGR5FWS4tOc3eivva2X8ihKaeiQNwa1bE02i9RJnb0Z4SB3lmvG4JXwjKZrhucdbwTU19S73g7gdZtu8BRmxF7R60pY7c1ok83KqnzX3JqHFiaSfETkSWj7jbeSW1OFTPN3+mkO4l9vJaQVFU72dSe2mt5FHUP0sEGSSN/OPVPfrhG3AZb5ZkIcDrvq4XMHMjzR7cCm+vYx/MC/8wAK3bYzJ02NI7SP/e1DVlEG+zjhvuds8FEcXWmW8HSzNwUjALelfDwbI4+BKtdTQtzdWyHn63yVtSyuHRjp7cGXH9yUz1NQDeSkgdxa1zT4OWl3qvtRGi0f/ZViFbQN6TJ5Tva0AeJCGixmg6o5mH71k0hxqEZSUj+wXHibqb2UMu2IDg9rm+Set8i09ANmkY2RSgDcWtPmVyudh1I3oMiHEaxK5WknugtrktqcauNWnYXD7haB5ErPVja1x1g544a7yey+S0zcIldm4OtubIQPFXwwQR+0dG34pA891lk8o6kzDmWtvZzpuYaSjaaKqObpqhw+yW5eK0E+l1FEbXv8DX3vwsAPFVt00if0Yqq28Nbb+pxU5lYOPqLDXyM/8dnMsJd25geCsjx2qI1WROAO0N1WDtIbdNJMfpSM4ZieLRfzsqxjdI8ajmSRD7TRn22v4JvUVVswBukUkXtWuHwzOJHejKfSGGQ+pUyxnc/0lu8FwSup0cppDeOqyP2g752UH6DP1dZkwc0dYGqM9mZKl3wGpow8Hp1FI8b3Fl/Ft16ZIfcnYD/tMY7xIWVh0aqGmwbfmEyg0TkObvSM+EADxKpXyLfgNmqHN+sa/wDi28iFWzG5xlH9FH8n5qwUFPBlM55+L8rLx9ThozsQN+pmm65Er7Lo8XrT05YwN0YaVOt0ydC3VDGvd95/mLWCrZWYe8WY8t4ljj5IOfA6N+YlDzwaQfEqXGLVJFXNa39wOT9I0982QD4TJ/xcFdT6cyuNyLDhrOHc838VRHo/RNJ1hJwtf5gK46NF+cLDq/edqjtULDkt6E5yYxOm0VrSNjv95j2+LXOVLNMae93NLx1COSQ9wIHmqqTQq/tmsA4SXPkixo8IT+6ppJBv12tHkSml6+47mE0OltJIdUCojPVfYfxAkq+aaqBvFG9zTsIfIb+NlbSxAjOARn73o3eJzRjJTGLlutwjH/VUlS7Hq9xT9JnPtY5OTfS38LKcdFrC7IKhvF2tbxcj34vrgtOtTu6i4l/hrZJU6hlcb/Ttbh6/kU031Qml+ZXUU9eOhE228tF+8lAF2IA5wa3aLIuekc365wO9tx8wgyyoGbKl7uBc781TUiLXqWwsrXf+M4H7rkxgoq77Lh8TnfIhLRiNSOnJLb7oB8wqJtI9TZHNId79QDusjXkacfUeyMxEdExnm958NZAT6QYlEc9XkGg+eaUR6bvBzp4zzAHi2ybUelcUgtJS2O9j/kSs9Hur+epebp0Vt0wqz7Ska8b7vb87IyDSSH36eNh3a5J/tVZmpiblk9t12/8AZXOjoANZ2u34mk+QVUl38/ILk+URn0jhGbabW/Fl4odulp9ylAO+4J+SgzSjDo3WFU8cBC+39qsqtK6fpRGOb+Vh7iy6ScXsO2tW/YX4jpBWP+oc5u4a4/tKSyYxIPa0stuEkg8HXTh36UmsNnUrgN7JG+RYAiJdPqSUZl7CRlrM+bS5pULEV0nX7DcdLsU0Wk2p7N1Qz7peHDuITOPTGV3vv7Wj8igJtMKZuyH0nEhov/SqGfpAjGyjYey3yVucVvRKT7NRR43I/wB654xt/wAJmKiYjINJ3asf/a6wMv6SHe7SRN73KzC9Oalzso4z93VA7ihYkZaJFbbsf4niNbFmIbj4NbyXijU4/U21vRSR9jXN8l6ryk5vVg76l7syHyfEHNb/AFFRFewdKGLuc75gJ7Lg591kY7vmlGI6P1b/AHmtbwA+SWZA4y3BpdJox6sdP63wta3yQg0mr29GJoaer1LeABVLtCnnpSXP4h8lL9mHxfaI4yNaPEqKkxWwyHS+ZvtY4rfj/wC1la7S+jPTiYT90u/6pQ6jB9XUZf4gfmiqTR9228TR98ssqysFJhUek9ATnC9g3tkd5XU5sfoBmypm5ESm3cbFRfgURHrT07eLbfIoCTB6FjvWqNfgwH8ipeZcjvtDeLGWSi0dXKObA3xLrql9RVxm7JJH/jb5KEWFU7xaCKUneXNHgiItG6sD1Rq8H6pV8ak6t6AM2lWIN2hpHFjT4hAVOl9QT60EJPGK/wA0wrcDqx0mDm0H5IH6LKMnMc7hqHzUZOgcpcnn7WEj97SMPwEx/wBqIpdI4DsorHeXud5hdC2YezpL8XNJRbIapwzg1R91gHmmk+xX6HsukdRa0bWsHVmMu9K5dJK9p1mzt7mH5Jn+py/Ivew8WNIU/wBlHtzIa8fDb5olCwTlwZWq0pqXH1nMJ36ouvItK6tuyQctRv5LUv0UY7azVPAg+G1VDRJrb2dty9ZhPdllzWThicSGn6CI6ZVrsvSAcmMHjZCS49VO6U8h4axt3BaQ6Kxe9IBysP7iFdT6IU5+t7bg+AHzS8WJ2FmQiqZdoJvvujoKuU5OMg+F7h4J/Pobq5tluFCLCI29OR/Y02VxwpLdkMGpsPlk6M0o+LMeaIfohUnMSRHm6xRVqdgzqNQcQ75KtslET/rrcmv/ACWjUUNIAkwqSDN8jL7mkn5Id+PPZlqscOIuVoWVlEBZ1eXcwT5qmaioJejUx345fNFrhhlYpixink9o0N+FjbK/6XStzZJ2CPPvKKZoxAejURAdh83K/wDZ2Bgv6YuO5rL+N0JyHlE0+mM0eUMcXxPYHE/kuh0viqPUq4dV3/2RXA7WH5Fe1kMYNjG8jfqoR+C07sw5zTuIUOM81pjUtKYVPgcT84nRyDcSWO7nIE4CWnoPbyzCi2smpfZvaR95ocO4hXU2n8jTaWCN4+6Cw+CJSw0/qQKLexM6OF4yuTxB80BLo1K3L0T+42vvWlpNNaJ/SimjPxXHeM0yGMwyZxAPP33Nv/U26eXDnsOmuTH0mjlT1QF3MJ7huisjj68AbvzCPmrq0ezhZbeNQ+SU12N1pykc8cALDwVJVsGnI+qdH6WMes6Np69d4HdYFBv0ZY9utTysefstIJ8Nqw2IMkebnWcL57bkdfJJhRyh12hwI2EXBHaFlLFlF7FJRZvI5pKd2q5sg7XBepRhGlNfFYOcZWj3ZBreJzXi1ji2hZfU9ZiuIdRe3n/lNcPrK49JzDzOqe9qT/Tag5Frid9irWmoP1Tu0Gyyjp2Ds1kbg72gmcfuTm3coSzRR5fQpHjrL3E+aTU89U0ZD0fEZeKGmxiYG0krHjdck94WjaEPX1tCelTyRn7tvNUSHD3DZOeGs0JbTVIecoHv+FzintJo7HINZ8T4hvedXzSBagUNXQMNvQk8XvJ8AE1gxnDwOhbkzLvKlDhmHsveUOI6g4O8gh67AWzD9zs3Jq60DYnPpFRbI5HN+GJt+8uWerMaOtrRum+IkjyKjPodM0npfykqyDR+p92/a0hRc+QdF1NpxVRjKTXG5+fjtVs/6S6nrji/q/NcNEqt+0AfyqqfQuduZAdyAUuMnsNSaK5P0lTkW9BGct8nycqGfpCrRk0RBu7VeR4vQdbgMzcvQvHIIA4LKfq389UrKSxC1NGik04rXC+rTkfw8/FyDdpxXWydGz4Y2j80rZhk4yDTbMdeYO9FQ6M1Ls2sJS/5XwK12H0mnNa03L2v+Jo+SKfp1UPyswHgB+SDh0YmHtGao3kgLybCImDIuJ3Cy0jHEolyGMGltSBZzI5G/Zds8EVTaQwO205jO9j8u4hZfWIOTSeaLp8XDPqGE7ybfOypTrdkbm1ppXOzYSRuIF1dKGHJ7pWHf6O47wVjhpDO42YNQfc/wiY6+oPTLnDi4hbLFUthbDar0eDs2zRv+K4PcVn67AXN90H4bJtBUt2tsDuLwjoqsuy9C3mCnlT3EYl0Ib0qcu5khTjqIxsp2t7ST4rcuo3uHsSfxBLqzAag9CnHeCfNS4Vsx0zKGoF7k6qPpca1ehI4Hlkqa7Rmq96K3aAl40eqQctUfjZ+ayzTT2Kyo00WkdWfrWuHEN+YU3xmT1nhvNuXkkkej1YBd7Tq7yRY9oUm0cTPayBh4HNaxk62E12Om08Owytbweh6nBoXC4dE7i1URSUHvTvfwsPNFDG6SIfu6cuO8ut4Ksye4UJZsGjB6XcFW2ma3oiR3JaSn0ridk+nAHYfkjW4/h+6x3DWGfPNRUeCq9TJtpKg9CKTxREdLiA+qkI5FPqnSfU9i1p5uulE/wCkGuacmx9rSfmlJ5eRpJlsENV1xOB4he1UWIAXDDbgAhmfpOrPeihd+Fw+ahVaeyygCSmicAbgG+R3jil5k+fn7DcEDSvqB04XA77ELleNO5QfYsA3az/zsuTWJHsWQYOxKQbauMcGAedlS/G5NjXucd9wjv1JDH09U8h+aiaqkj+qPMlo8FVMQjrYaifa557UC3R57c3XAWqOMwnIT+i4aoPivCGyDKqEnC1lLw4t6jtozzcSFOLRufrbwbJdNiL3m73PdzcT5rTvwV18oXP5XVkWj8jj/pgN5e8DzKmUG+QRk24m5nQFkbBpBN9uQcnuWilwyNg9aOM8GOBSqq1NjYHAcAp8cl+ILXRGLSqoBuJXH47O80zi03rTkWxSDi0jyKUxxQ+8x47EUymYeg+3MEJxhLsTkP4MYmlHrU4HJ5HmukxSoi6Mbx+In5LOyYbVbWPuOBRFNitTB7STsOa0zcMkZU+PTF2dMDfadQZ87BN465xs76OIyPe1R/yaUg/bh5yDg3jqBeHS0Hpv1/wkeSSnHsepo5MdY3pPud3owfIBBVGlTDk29/ha3zBSR+MQP90tQcjor3Fz2ozLhg5M11NjLnD2Ifxdqv8ABoCmWB3ThjHJpCy9LWhuxvjZOabG9UZx3+KWwVRkib7D2UEB909n+UfBgkR9xn4glP7URDpRxjlI4/JVS49SO2vcOA1ihyRWg+dozG/IGMfC6yUYnofO2/oy026tbPxSerx4jKK4G+1igo8fmBzmm/nu3+UiyyliUUsr4C36LVF/WiI/93q+LRiYbI3HkVXSaY1A6L2X3loB8FOs0trSOnb4QE01wT9IZFgMw23ZzciGYbVN6FUByJKyUulVXf2hPOynFpjWD3xb4Qq8sRpI0009YzN0xf8AgB8bJdPpLVNObbjkR5KdDpeXe0n1T8IITePHmEe2a8fAq0ewhKzEDNk70jTuuSEFW4FE7Ml11oZcSgJzdY79UjyVsTC8fup2Hg4j5q2k1qL8jBy6PW6DHFexYXM3ZET2LcTYfWDYI+Yt8kqqpahnSlDeQWeSPBWvIhdBVHIw2Hwqhzmx9OG5TCoxZ5yM7z4JZNWj3ruUulyARDiVM/1XMLOIVz8CZJ60UwI52KV/S4OuNymyviHRa4JKaejoKfAU7BgzpTNHiqX+hHvtd2KYg9JsuV36hd9h3cnT/ChfmUF1ONrCeRXqk/B3DqI5hcpqfRSoI/XETspYL8QbKmSqouqKS/xK+n0e1toIG/WC6pwiGMZ6x7QfJU1N9D0AjjcTOhE38YupxaUC/sYuwEIWWnj6hdeNiYNjM1m/J2P6R6zSd9vUGpyJVMtex+cr5XHdclBU1KSc7AJg2pZHsGsVaUnuQ64LKSSH3dZvxApozES3om/I/mEuhnklNvRZdyYfqeUC7ZI4zuLwtFsKrPHaQSbCwH4gD8kPLUzv2RNHwheuoqwZemjI5tKthwp211Wxp4H8ktQoEFBVu2B3YFdHhdT78LncwSi5q8wjKqc/4f8AKV1WmE2erI7ndTKo62NJDqk0abJ7WAx367geBVs/6PYi6zZbc7eIWLk0mqCc5Hn8RRVNpQ5tvVDjxKyeJhvf2KSoey/o/maciCN91ZDoQ4dJ4Hal0en9QMg1oHaVTUadVDupo7ElPCG4j9+Bwxj1nE8ilNVS0p+1filzNLHn2jA7wRUWMUrumx7eRB8wtFiYctiHFoFlw+P3bod1Pq7AnsOIYefelHNv5I+Krw7e48w5Jxg+hUzMwAneU5pcJa4Xcx/4UwkxOkZnHFfiQUKdLZAfVY2261vJNKMdwISYTT7pAeIVsFGG7AXDcUZHpW1w9aGx3tcfIpbV49n6rnN5j8lacdwZdUxt/wDzDnmlFTQl2TY9VFxY1ITlKDzTWk9LJ1g8gFWjEZGTRqd2xvirKfRaqbmMu1boYU8C7ifBAVLng2YCo8ULtF5nyAUWHVIycNYckzbh8LReXWZysgH4ZVybL252VD9Dak5lw7XK3KtBJDyjxemjNmumPZcJ3FPTzC3qnmLFfOqjR+oZ1+KBP7s3e5xPAqb7LUj6JX6NwHMttyCTT6OU/UbpVh+mgjy1pLbnWITiPTend02kcQAhSXYUmKp8Jjb9XdV+mhZtow7tIT06WUR2ud/J+RQdTpRh/wDuO5N/yhziLIxc3SBgybRNbxu5WHG3n3CBuBKtbptRN2U73HiAEDU6eNv6lO38VvkFCxUuRuJf+sGuydrN47VyW/tw87aaE9hXKljxFkMk6qe7a496JpIne7IRwN0AwWV0dSQuZPXU3a6NBTOeNuq5MYXPP1APJJaHEbbW35p1Dpc6Meq1g7LrpUlW5g1qHQ4S+X6hwRLdFSzN1m/E4DyWcrv0g1RybIGjg0JQcbnmPrOc8lT5VZWRUbippGNFvpTL7m5+KSPwqQuu1+sN90jko5jnqkKk0lQPteKcsR9MSj6mui0ZleOmB2rjoY4dKdg/EslC2oB9/wAUcypkZ08+ZUZk90DVGopdGIhtka78YCZR4TTM2xxu/ESsDLjY6mW43VLcadvsn5YIWWR9DkhpeukFt4N0DPhFE/oh8Z3EELKw4tP1ONtybUWKuPSJaf8A3qKpSjLgT0CH6LsGxz7fCV6NGYvtO7bBNKfFDbMtdzy8QVbI+FwzBbycPmn44dBfqI5dGY25iRUx6PMJ6aeGvpGbZHefzUZNI6IZAEngB53SrDQUwSLBKWPN8hcdwC9NbTR9GDW4uQdZjMZ6DO9LJnyOzAUSaX+IqfI9GkF+jBGEFVYqT9U3sSj0jm7claai6xeLLZjyl7a0/Y7lezFYz0mpc8nqCoc0/ZTU5IMqY7FfCMwy6jLpJI0Wja1vEbfFIXA7iuDXIeLIpRSCpMYqib+kcV6MbnHvFDifVXPqifd8FOd9sdegQ7SKq6p3jtVX7Q1PXK48yh9vUpinCWaXY9OgtuNSHJznW5qwMEmYfnuKBY0Dai4Yh7q1jJ8kuiZw/eQomhA6wimwyfZuEXTwMdlI3V4rVJPgm2Aw0MLsnP1UV+zsRF2yh3Io8aKxPzbM0cCVA6IubmJW9hRl7Q9RNPg0bdpKGdDC3bc8FonaPykZODuRSuswZ46Qt2JSh0gT7FckUbujkuVzqAD3guWeXtDTB5NHKu/sj3L1ujVR1sst7TYoyQerVDtYQvZo+v0+tyA+a1WHFmjkzEN0bqDsb4q1miD9ssrGDncpviNY9uwOKyuJYpId6JQhHclW9h19Dw+mF3kzuHUcmoOo03ePVhiijb91gv3lZSWQk5m66KIlc7xXtFUarDW7NDDpG9xu83Tmix2IZl/Za6x2oBtXgkZxVLGktyXhp7H0E6TQEWy52Qsk1HJm6QjkFimyjcUVDGTwVLHb4IcKNM6iojse/wDlQs2DwbWuJQkDmszc8ckdHjkY2tDlf0PeiNeAT6AR0Lq2Ojm62lEftY1vQp2cySV6NMJD7jByCm8Ncjyssiw5+0khGQUbT0nG3NKJMfldseRwVRx6XZcdwR5IIWRml/U1Ic3PPgrocCo3bCVlP1i520q36WQOl4qfLDoKZrX6OUzRcOf2C6GNPTjLWf3LNQYnK05PPer245JfPPuTWNDoHFjKuw6M5tce0JNNEBvTmk0mI6UbHcCEa3G6Z3To2niHEKqjLVCSrczTJtXYrTWHgexaMV9KdlKO9SJpT9SW+KeRrkNDNsr98YK59aw7Y7ck7n9B1NPcldVHH7t0nF9hoBl0f2SFOKojbtbfmhJmFBuJ3rBya4Ky2aWLFacbYQjYauF+xjRzWOa1SaSOtJY75H4+jb+gg642nkV4H0oyMZHIhY0Yg8da9+nuO1af3EeheNm0Dac9F8rexUzxNOx7u0LJMxF7ei9w5FGw6W1TPfa8bnsaf8p/3ER+NhdTTu6noYOnbscUTHpgx3tqRh4xkt8M1N2kNKc2wuHAlPPB8g4tHU2ITt2sJ5XujzjLiLHW5OF0sZpHBfON7eRumVLjdK7IyW4Pb8wtYzj2S4sW1sod7o7Fy0cMVM/oyRnkQuTdMFFnzY4i5nHsU26WytybkvZKOR+Tc1U7RioP1R7FjLycHRFQ5Jv0undkX+AQzsQ1+lYqt+jk42xu7kRTaOTH3SFCeK9ymoLYp1o/slVvm3CydM0XlHuk9i8lw17elGe5VkkRaM84EqbYR1o+emt7pCCew9SycKLzWSEobsUXVBKgKZ590qRgeOoqHmCkRvvVjXqjUduKkAVOo6DGzM6wV7a+wFBFWRSEbCVebsjL0EsD9xRsFM53ulQp8Ukbs8QEUNIJt9uQCtOHNkuLZF2GSDqKqNG9Wy6Ry/av2BCurXP60Vhvayakg2Cit0ngdqLbRRnZIEjfTv27VV6QtRaj+EMt8jqaPU2EFUtr3XSmSoO9RbOpeLWw/GaejxoMOYTMaTHqa3uWF9Iiopza18tyfnkHjRrv2oPvRsd2K+nx2kflIws4jMLH+kUmtv1prHkLIjfNwilmF4pmk7r2KT4no45nVcb1noWPYbgrQ4fj5As5/fmFtGUZf5EtVsIJqZzTsVLncF9ApqiKTaIndtiinYXERlA08iCol/TpvRjUj5iTwUS9bjEMG3RWSCowsDaLLN/07HnEZevLpo5kTdtyqzUx9TFHirkrMAdi6yNc8HMBUPcEOFBZTZcWLxyjrKCiJBHWuXOeuTGPqU2OWXJazC5XZese8rxcvSWxlyaKI3Lbo7UG4dy8XLB7s6VsUYgP3J/ifIJThjiZACbi+zqXLlOHyPE4Ox6mZboN7gsm+nZfot7guXLoWxzS3GFLC23RHcEHWRi+wdy5crM2K6qMW2DuSiVovsXi5YzKiVOaF5GM1y5YspB9O0bkXqDcO5cuWsdhMFljG4dyHc0bly5RICOsd6Cn2rlyykXEqUQuXLGRoWq6NerkREyxquYuXIJYQCvJF4uWq2IOYptncDk5w5Erxcp5HwM6ark+27+YqU8hIzJPavVy6E9DJ7iuZCSrxcspFonEV49cuS4Aiq5Fy5SxoqXLlyRZ/9k=">
        <h1 style="text-shadow:1px 1px 0 #fff;">asd fasdf</h1>
        <h1>This is header1 content</h1>
        <div class="bg-white" style="height: 72px;width: 310px;">
            <h3 style="padding: 0 6px 0 0; box-shadow: 3px 3px 7px #555555;height: 50px;width: 300px;background:#e7e6e6 url('https://www.w3.org/2008/site/images/category-bg-fold.png') no-repeat bottom right;">This is header3 content</h3>

        </div>
        {{--        <p>This is my paragraph content.</p>--}}
    </div>

    {{--    </div>--}}
    <script>
        $(function(){
            $("#group a").addClass("active-group");

            $("#group").addClass("active2");

        });
    </script>




</div>
</body>
</html>
