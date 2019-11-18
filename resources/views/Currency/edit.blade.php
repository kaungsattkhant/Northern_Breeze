@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
        <div>
            <form action="{{url('currency_group/update')}}" method="post">
                @csrf
                @method('patch')
                <input type="hidden" name="id" value="{{$currency_groups->id}}">
                <div class="d-flex justify-content-between top-box-mount shadow-sm">
                    <div  class="my-auto btnzz ml-4">
                    </div>
                    <button type="submit" class="btn btn-nb-mount px-4 my-auto mr-5 fontsize-mount2"  data-toggle="modal" data-target="#create"> Save </button>
                </div>

                <div class="bg-white table border-0 bg-white box-shadow-mount rounded-table-mount col-lg-5 mt-5">
                    <div class="p-3">
                        <div class="mb-2 pr-5 fs-select4">
                            <label for="#currency" class="w-25 fontsize-mount pt-2"> Currency</label>
                            <select class="selectpicker show-menu-arrow bd-bottom-mount mount-input3" id="currency" name="currency">
                                <option selected disabled>--None--</option>
                                @php
                                    $currencies=\App\Model\Currency::all();
                                @endphp
                                @foreach($currencies as $currency)
                                    <option value="{{$currency->id}}"
                                    @if($currency->id==$currency_groups->currency->id)
                                        selected="selected"
                                        @endif
                                    >{{$currency->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="#GN" class="w-25 pt-2 fontsize-mount">Group Name</label>
                            <input type="text" id="GN" name="group_name" class="pl-2 pb-1 border-top-0 border-right-0 border-left-0 rounded-0 mount-input3 bd-bottom-mount pb-1" value="{{$currency_groups->name}}">
                        </div>
{{--                        <div class="mb-1 ">--}}
{{--                            <p class="w-25 pt-2 fontsize-mount " style="position: absolute;left:30px">Note</p>--}}
{{--                            <div class="d-inline fs-select4 pl-1" style="left: 53%;position: relative" >--}}
{{--                                <select class="selectpicker bd-bottom-mount show-menu-arrow" multiple data-selected-text-format="count > 5" title="Select options" name="notes[]">--}}
{{--                                    @php--}}
{{--                                        $notes=\App\Model\Note::all();--}}
{{--                                    @endphp--}}
{{--                                    @foreach($notes as $note)--}}
{{--                                        <option value="{{$note->id}}"--}}
{{--                                        @if($currency_groups->notes->containsStrict('id',$note->id)) selected="selected"--}}
{{--                                            @endif--}}
{{--                                        >{{$note->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="mb-2 pr-5 fs-select4">
                            <label for="#currency" class="w-25 fontsize-mount pt-2"> Notes</label>
                            <select class="selectpicker show-menu-arrow bd-bottom-mount mount-input3"  multiple data-selected-text-format="count > 5" title="Select options" name="notes[]">
{{--                                <option selected disabled>--None--</option>--}}
                                @php
                                    $notes=\App\Model\Note::all();
                                @endphp
                                @foreach($notes as $note)
                                    <option value="{{$note->id}}"
                                    @if($currency_groups->notes->containsStrict('id',$note->id)) selected="selected"
                                    @endif
                                    >{{$note->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
            </form>

        </div>


    </div>

    <script>
        $(function(){
            $("#group a").addClass("active-group");

            $("#group").addClass("active2");

        });
    </script>
@endsection

