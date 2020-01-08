@foreach($stock_notes as $note)
    <tr id="from">
        <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">{{$note->name}} </td>
        <td class="text-right border-top-0 pt-4 pb-4">
            <input type="hidden" name="from_group[]" value="{{$note->group_id}}" class="from_group_id">
            <input type="hidden" name="from_note_id[]" value="{{$note->id}}" class="from_note_id">

{{--                        <input type="text" name=notes[] class="note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1 "    placeholder=""   >--}}
{{--            <input type="text" name=from_notes[] class="from_note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1 "    placeholder=""--}}
{{--                   onchange=" return total_currency_value({{$note->group_id}},$(this).val(),{{$note->name}})"--}}
{{--            >--}}
            @php
            $classification=\App\Model\Classification::all();
            @endphp
            @foreach($classification as $c)
                <input type="hidden" name="from_classification_id[]" value="{{$c->id}}">
                <input type="hidden" name="from_class_note_id[]" value="{{$note->id}}">
                <input type="hidden" name="from_class_group_id[]" value="{{$note->group_id}}">
                <input type="text" name="from_classification_{{$note->id}}[]" placeholder="Class" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1 ">
                <br>
                @endforeach
        </td>
    </tr>
@endforeach
<tr>
    <td class="border-top-0 text-nb-mount" style="padding: 30px;"></td>
    <td class="text-left border-top-0">
        <p class="total-text-mount pl-5 ">Total :<span class="total_value"></span><i>MMKs</i></p>
        <p class=" total-text-mount fontsize-mount3 pl-5" >ပြန်အမ်းငွေ :</p>
    </td>
</tr>



{{--@foreach($stock_notes as $key=>$note)--}}

{{--    <tr>--}}
{{--        <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">{{$note->name}} </td>--}}
{{--        <td class="text-right border-top-0 pt-4 fs-select4">--}}
{{--            <div class="d-inline-block">--}}
{{--                <input type="hidden" name="from_group[]" value="{{$note->group_id}}" class="from_group_id">--}}
{{--                <input type="hidden" name="from_note_id[]" value="{{$note->id}}" data-id="{{$note->id}}" class="from_note_id" id="from_note_id-{{$key}}">--}}
{{--                <input type="text" name=from_notes[] id="from_notes-{{$key}}" class="  from_note_class border rounded-table-mount text-center fontsize-mount3 pt-1 for-placeholder" style="width:39.5%" placeholder="ရွက်"--}}
{{--                       onchange=" total_currency_value({{$note->group_id}},$(this).val(),{{$note->name}})"--}}
{{--                >--}}
{{--                <select data-width="fit-content" name="classification[]">--}}
{{--                    @php--}}
{{--                        $classification=\App\Model\Classification::all();--}}
{{--                    @endphp--}}
{{--                    <option disabled selected><b>Choose</b></option>--}}
{{--                    @foreach($classification as $c)--}}
{{--                        <option value="{{$c->id}}">{{$c->name}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <button  type="button" class="bg-transparent border-0 append-btn d-inline" id="{{$key}}" ><i class="fas fa-plus plus-btn-mount"></i></button>--}}
{{--            <div id="add-input-select-{{$key}}" >--}}


{{--            </div>--}}
{{--        </td>--}}
{{--    </tr>--}}

{{--@endforeach--}}
{{--<tr>--}}
{{--    <td class="border-top-0 text-nb-mount" style="padding: 30px;"></td>--}}
{{--    <td class="text-left border-top-0">--}}
{{--        <p class="total-text-mount pl-5 ">Total :<span class="total_value"></span><i>MMKs</i></p>--}}
{{--        <p class=" total-text-mount fontsize-mount3 pl-5" >ပြန်အမ်းငွေ :</p>--}}
{{--    </td>--}}
{{--</tr>--}}
{{--<script>--}}
{{--    $(document).ready(function(){--}}
{{--        n=0;--}}
{{--        $(".append-btn").click(function(n){--}}
{{--            // alert();--}}
{{--            var aa=$('#from_note_id-'+this.id).data('id');--}}
{{--            c=this.id;--}}
{{--            $('#group #node_object').val(aa);--}}
{{--            $('#add-input-select-'+this.id).append(`--}}
{{--            <div class="d-inline-block appended-item" id= 'group-' >--}}
{{--                 <input type="hidden" name="note_group[]" >--}}
{{--                 <input type="text" name="from_notes[]" class="border rounded-table-mount text-center fontsize-mount3 pt-1 for-placeholder" style="width:35.5%" placeholder="ရွက်">--}}
{{--                 <select class="select-append" data-width="fit-content" name="classification[]">--}}
{{--                @php--}}
{{--                  $classification=\App\Model\Classification::all();--}}
{{--                @endphp--}}
{{--                <option disabled selected><b>Choose</b></option>--}}
{{--                @foreach($classification as $c)--}}
{{--                 <option value = {{$c->id}} >{{$c->name}}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--            <button  class='bg-transparent border-0 delete-appended-item pad-l' onclick="deleteItem(this.id)" ><i class="fas fa-times plus-btn-mount"></i></button>--}}
{{--        </div>--}}
{{--`);--}}
{{--            $('.select-append').selectpicker();--}}
{{--            $.each($('.delete-appended-item'),function (ind) {--}}
{{--                $(this).attr('id', 'item-' + parseInt(ind+1));--}}
{{--            });--}}

{{--        });--}}
{{--    });--}}


{{--    function deleteItem(id){--}}
{{--        $('#'+id).parent().remove();--}}
{{--    }--}}

{{--</script>--}}
