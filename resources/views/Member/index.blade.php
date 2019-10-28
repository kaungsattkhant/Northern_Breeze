@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
        <div class="d-flex justify-content-between top-box-mount shadow-sm">
            <div  class="my-auto btn-m ml-2  dropdown">
                <select class="border-0 rounded-0  bg-white  text-color-mount fontsize-mount22 pl-4 btn-m" style="height: 50px;" id="member_filter">
                    @php
                    $member_types=\App\Model\MemberType::all();
                    @endphp
                    <option selected disabled>Member Types</option>
                    @foreach($member_types as $mt)
                        <option value="{{$mt->id}}">{{$mt->name}}</option>
                    @endforeach
                </select>

                    <form action="{{url('member/search_name')}}" method="get" class="d-inline">
                        <input type="text" name="name" placeholder="Search name..." class="fontsize-mount2 border-0 ml-5 pl-2 input-name">
                </form>
            </div>
            <button type="button" class="btn btn-nb-mount px-4 my-auto mr-5 fontsize-mount2"  data-toggle="modal" data-target="#create"> Add </button>
        </div>
        <div class="pt-5">
            <table class="table bg-white box-shadow-mount rounded-table-mount"  id="myTable">
                <thead>
                <tr>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6" >Name</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Member Role</th>
{{--                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Point</th>--}}
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Phone Number</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($members as $member)
                <tr>
                    <td scope="row" class="table-row-m"><a href="member-data.html" class="text-decoration-none text-dark fontsize-mount2">{{$member->name}}</a></td>
                    <td class="table-row-m fontsize-mount2">{{$member->member_type->name}}</td>
{{--                    <td class="table-row-m fontsize-mount2">{{$member->}}</td>--}}
                    <td class="table-row-m fontsize-mount2">{{$member->phone_number}}</td>
                    <td class="table-row-m fontsize-mount2">
                        <a>
                            <i class="far fa-edit mr-3 text-info" onclick="editMember({{$member->id}})"></i>
                        </a>
                        <a >
                            <i class="far fa-trash-alt text-danger" onclick="deleteMember({{$member->id}})"></i>
                        </a>
                    </td>
                </tr>
                    @endforeach


                </tbody>
            </table>
        </div>

    </div>

    @include('Member.create')
    @include('Member.edit')
    @include('Member.destroy')
    <script>
        $(function(){
            $("#member a").addClass("active-m");
            $("#member").addClass("active2");
        });
    </script>
    @endsection
@section('script')

    <script src="{{asset('js/member.js')}}"></script>
    <script src="{{asset('js/bod.js')}}"></script>
    @endsection
{{--@section('script')--}}
{{--    <script>--}}
{{--        $(function () {--}}

{{--            for (i = new Date().getFullYear() ; i > 1900; i--) {--}}
{{--                $('#years').append($('<option />').val(i).html(i));--}}
{{--            }--}}

{{--            for (i = 1; i < 13; i++) {--}}
{{--                $('#months').append($('<option />').val(i).html(i));--}}
{{--            }--}}
{{--            updateNumberOfDays();--}}

{{--            $('#years, #months').change(function () {--}}

{{--                updateNumberOfDays();--}}

{{--            });--}}

{{--        });--}}

{{--        function updateNumberOfDays() {--}}
{{--            $('#days').html('');--}}
{{--            month = $('#months').val();--}}
{{--            year = $('#years').val();--}}
{{--            days = daysInMonth(month, year);--}}

{{--            for (i = 1; i < days + 1 ; i++) {--}}
{{--                $('#days').append($('<option />').val(i).html(i));--}}
{{--            }--}}

{{--        }--}}

{{--        function daysInMonth(month, year) {--}}
{{--            return new Date(year, month, 0).getDate();--}}
{{--        }--}}
{{--        </script>--}}
{{--        @endsection--}}


{{--@section('script')--}}
{{--    <script>--}}
{{--        $(function () {--}}

{{--            for (i = new Date().getFullYear() ; i > 1900; i--) {--}}
{{--                $('#Eyears').append($('<option />').val(i).html(i));--}}
{{--            }--}}

{{--            for (i = 1; i < 13; i++) {--}}
{{--                $('#Emonths').append($('<option />').val(i).html(i));--}}
{{--            }--}}
{{--            updateNumberOfDaysE();--}}

{{--            $('#Eyears, #Emonths').change(function () {--}}

{{--                updateNumberOfDaysE();--}}

{{--            });--}}

{{--        });--}}

{{--        function updateNumberOfDaysE() {--}}
{{--            $('#Edays').html('');--}}
{{--            month = $('#Emonths').val();--}}
{{--            year = $('#Eyears').val();--}}
{{--            days = daysInMonthE(month, year);--}}

{{--            for (i = 1; i < days + 1 ; i++) {--}}
{{--                $('#Edays').append($('<option />').val(i).html(i));--}}
{{--            }--}}

{{--        }--}}

{{--        function daysInMonthE(month, year) {--}}
{{--            return new Date(year, month, 0).getDate();--}}
{{--        }--}}
{{--    </script>--}}
{{--@endsection--}}
