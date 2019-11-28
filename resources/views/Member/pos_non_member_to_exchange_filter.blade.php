@foreach($stock_notes as $note)
    <tr>
        <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">{{$note->name}} </td>
        <td class="text-right border-top-0 pt-4 pb-4">
            {{--                    <input type="text" name=notes[] class="note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1 "  onfocusout="return stockValidation({{$note->name}})" id="input1" placeholder="">--}}
            <input type="text" name=notes[] class="note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1 "   id="input1" placeholder="">
            <span class="note_error[]" id=""></span>
            <input type="hidden" name="group[]" value="{{$note->group_id}}">
        </td>
    </tr>
@endforeach
