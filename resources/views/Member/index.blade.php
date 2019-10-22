@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
        <div class="d-flex justify-content-between top-box-mount shadow-sm">
            <div  class="my-auto btn-m ml-4  dropdown">
                <select class="border-0 rounded-0  bg-white  text-color-mount fontsize-mount22 pl-4 btn-m" style="height: 50px;">
                    <option selected disabled>Member Roles</option>
                    <option>1111</option>
                    <option>22222</option>
                </select>
                <input type="text" name="name" placeholder=" Name..." class="fontsize-mount2 border-0 ml-5" style="background-color: #eeeeee;border-radius: 8px;height: 29px;">
            </div>
            <button type="button" class="btn btn-nb-mount px-4 my-auto mr-5 fontsize-mount2"  data-toggle="modal" data-target="#create"> Add </button>
        </div>
        <div class="pt-5">
            <table class="table bg-white box-shadow-mount rounded-table-mount"  id="myTable">
                <thead>
                <tr>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6" >Name</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Member Role</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Point</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Phone Number</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td scope="row" class="table-row-m"><a href="member-data.html" class="text-decoration-none text-dark fontsize-mount2">Khant</a></td>
                    <td class="table-row-m fontsize-mount2">Diamond</td>
                    <td class="table-row-m fontsize-mount2">10000</td>
                    <td class="table-row-m fontsize-mount2">09785423364</td>
                    <td class="table-row-m fontsize-mount2">
                        <a href="#" data-toggle="modal" data-target="#edit">
                            <i class="far fa-edit mr-3 text-info"></i>
                        </a>
                        <a href="#" data-toggle="modal" data-target="#destroy">
                            <i class="far fa-trash-alt text-danger"></i>
                        </a>
                    </td>
                </tr>


                </tbody>
            </table>
        </div>

    </div>

    @include('Member.create')
    @include('Member.edit')
    @include('Member.destroy')
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
