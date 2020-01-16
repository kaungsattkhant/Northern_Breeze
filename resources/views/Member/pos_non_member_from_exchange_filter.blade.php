


    @foreach($stock_notes as $note)
        <tr id="from">
            <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">{{$note->name}} </td>
            <td class="text-right border-top-0 pt-4 pb-4">
                <input type="hidden" name="from_group[]" value="{{$note->group_id}}" class="from_group_id">
                <input type="hidden" name="from_note_id[]" value="{{$note->id}}" class="from_note_id">
                <input type="text" name=from_notes[] class="from_note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" placeholder=""
                       onchange="return total_currency_value({{$note->group_id}},$(this).val(),{{$note->name}})">
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
<script>

    // $(function(){
    //     // alert('Hello World');
    //
    //     array=[];
    //     note=[];
    //     notes_id=[];
    //     $('.from_group_id').each(function (){
    //         var gp=$(this).val();
    //         array.push(gp);
    //     });
    //     // console.log('array'+ );
    //     // groups=$.unique(array);
    //     $('.from_note_id').each(function (){
    //         var n=$(this).val();
    //         notes_id.push(n);
    //     });
    //
    //     $('.from_note_class').each(function () {
    //         var val=Number($(this).val());
    //         note.push(val);
    //     });
    //
    //     const array_combine = (keys, values) => {
    //         const result = {};
    //
    //         for (const [index, key] of keys.entries()) {
    //             if(values[index]===0)
    //             {
    //                 result[key]=0;
    //             }
    //             else
    //                 result[key] = values[index];
    //
    //         }
    //         return result;
    //     };
    //
    //     group_note=(array_combine(notes_id,array));
    //     note_array=(array_combine(notes_id,note));
    //     console.log('group_note',group_note);
    //     var n=0;
    //
    //     function getValue()
    //     {
    //         $.each(group_note,function (note_id,k) {
    //             // var gp_id=Number(group_id);
    //             $.each(note_array,function (id,value) {
    //
    //                 $.get({
    //                 url:'non_member/'+k+'/get_group_value',
    //                 success:function (data) {
    //                     // console.log('data'+data);
    //                     console.log(value);
    //                             if(note_id===id)
    //                             {
    //                             n+=+1 * Number(data);
    //                             }
    //
    //
    //                 }
    //             });
    //             });
    //             console.log(n);
    //
    //         });
    //         // console.log('nnnn'+ n);
    //
    //         // $('.from_note_class').each(function (k,v) {
    //         //     n += +$(v).val();
    //         // });
    //         return n;
    //     }
    //     $('.from_note_class').change(function(){
    //
    //         $('.total_value').html(getValue());
    //     });
    // });
    </script>

