


    <div class="col">
        <table class="table border-0 bg-white box-shadow-mount border-tab-radius-mount" id="stock_table_filter">
            <tbody class="rounded-table-mount" >
            @foreach($stock_notes as $group_name=>$stock_note)
                <tr>
                    <td>
                        <h3>
{{--                            Group-{{$group_name}}--}}
                            @php
                                $gp_name=\App\Model\Group::whereId($group_name)->first();
                            @endphp
                            {{$gp_name->name}}
                        </h3>
                    </td>
                </tr>
                @foreach($stock_note as $note)
                <tr>
                    <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">{{ $note->name}}</td>
                    <input type="hidden" name="note_id[]" value="{{$note->id}}">
                    <td class="text-right border-top-0 pt-4">
                        <p class="text-color-mount fontsize-mount2">{{$note->total_sheet}}</p>
                    </td>
                </tr>
                    @endforeach
            @endforeach
            </tbody>
        </table>
        <div class="div-p-mount2">
            @if($total!=null)
                {{$total}}
                @endif
{{--            <p>Total : {{$total}} MMKs </p>--}}

        </div>
    </div>
    <div class="col">
        <table class="table border-0 bg-white box-shadow-mount rounded-table-mount mt-0 pb-5">
            <tbody class="rounded-table-mount ">

            @foreach($stock_notes as $group_name=>$stock_note)
                <tr>
                    <td>
                        <h3>
{{--                            Group-{{$group_name}}--}}
                            @php
                               $gp_name=\App\Model\Group::whereId($group_name)->first();
                            @endphp
                            {{$gp_name->name}}
                        </h3>
                    </td>
                    <td class="text-right border-top-0 pt-4 pb-4">
                        @php
                            $classifications=\App\Model\Classification::all();
                        @endphp
                        @foreach($classifications as $classification)
                            <input type="text" name=classification-{{$note->name}}[] class="note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1 "   id="input1" placeholder="" onchange=" check($(this).val())">
                        @endforeach
{{--                        <input type="text" name=group_value[] class="note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1 "  placeholder="" >--}}

                    </td>
                </tr>
                @foreach($stock_note as $note)

                    <tr>
                        <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">{{$note->name}} </td>
                        <td class="text-right border-top-0 pt-4 pb-4">
                            {{--                    <input type="text" name=notes[] class="note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1 "  onfocusout="return stockValidation({{$note->name}})" id="input1" placeholder="">--}}
{{--                            <input type="text" name=notes[] class="note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1 "   id="input1" placeholder="" onchange=" check($(this).val())">--}}
                            @php
                              $classifications=\App\Model\Classification::all();
                            @endphp
                            @foreach($classifications as $classification)
                                <input type="text" name=classification-{{$note->name}}[] class="note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1 "   id="input1" placeholder="" onchange=" check($(this).val())">
                            @endforeach
                            <span class="note_error[]" id=""></span>
                            <input type="hidden" name="group[]" value="{{$note->group_id}}">
                            <br>
                            <span class="text-danger">
                                <strong class="check_input"></strong>
                            </span>
                        </td>
                    </tr>

                    {{--                @if($note->group_id==)--}}
                    @endforeach

            @endforeach
            </tbody>
        </table>
        <div class="div-p-mount2">

            <p>Total :</p>
        </div>

    </div>

