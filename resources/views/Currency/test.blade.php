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

        .bootstrap-select .dropdown-menu {
            border-radius: 13px !important;
            border:5px solid gray;
        }
        .yolo:hover{
            background-color: #eeeeee;
            box-shadow: -0px -0px 2px #777777 inset;
        }

    </style>
</head>
<body>

<div class="overall-container-mount3">
<div class="sidebar-nb-mount shadow mr-0">
    <ul class="nav flex-column mr-0 pt-3" id="myDIV" style="position: relative;">
        <li class="nav-item dropdown btn-mount mx-auto mb-1" data-toggle="collapse" href="#pos">
            <a class="nav-link p-0  sidebar-box-mount img-pos text-center" href="#"  role="button" aria-haspopup="true" aria-expanded="false">
                <div class=" mt-0 px-auto "><p class="sb-text">POS &nbsp; <i class="fas fa-chevron-down"></i></p></div>

            </a>
{{--            <div class="dropdown-menu dp-mount" id="menu" style="border: 5px solid grey; border-radius: 10px;">--}}
{{--                <a class="dropdown-item" href="{{url('non_member')}}" >Non-Member</a>--}}
{{--                <a class="dropdown-item" href="{{url('pos_member')}}" >Member</a>--}}

{{--            </div>--}}

        </li>
        <div class="rounded-0 collapse border-0" id="pos" style="width: 100%">
            <div class="rounded-0 border-0 py-0" style=";background-color:#eeeeee;width: 100%">
                <a class="dropdown-item pl-4 py-3" href="{{url('non_member')}}" style="box-shadow: 1px 1px 10px #666666 inset;">Non-Member</a>
                <a class="dropdown-item pl-4 py-3" href="{{url('pos_member')}}" style="box-shadow: 1px 1px 10px #555555 inset;" >Member</a>
            </div>
        </div>
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

        <li class="nav-item mx-auto">
{{--            <p>--}}
{{--                <a class="btn " data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">--}}
{{--                    Link--}}
{{--                </a>--}}

{{--            </p>--}}

        </li>
        <li class="nav-item btn-mount mx-auto" id="staff">
            <a class="nav-link p-0  sidebar-box-mount img-staff text-center " href="{{url('staff')}}">
                <div class=" mt-0 px-auto "><p class="sb-text">Staff</p></div></a>
        </li>

    </ul>

</div>

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
