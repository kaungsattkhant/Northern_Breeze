@foreach($stock_notes as $note)
    <tr>
        <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">{{$note->name}} </td>
        <td class="text-right border-top-0 pt-4 pb-4">
            <input type="hidden" name="to_group[]" value="{{$note->group_id}}" class="to_group_id">
            <input type="hidden" name="to_note_id[]" value="{{$note->id}}" class="to_note_id">

            {{--            <input type="text" name=notes[] class="note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1 "    placeholder=""   >--}}
            <input type="text" name=to_notes[] class="to_note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1 "    placeholder=""
                   onchange="return to_total_currency_value({{$note->group_id}},$(this).val(),{{$note->name}})"
            >
        </td>
    </tr>
@endforeach
<tr>
    <td class="border-top-0 text-nb-mount" style="padding: 30px;"></td>
    <td class="text-left border-top-0">
        <p class="total-text-mount pl-5 ">Total :<span class="total_value1"></span><i>MMKs</i></p>
        <p class=" total-text-mount fontsize-mount3 pl-5" >ပြန်အမ်းငွေ :</p>
    </td>
</tr>
