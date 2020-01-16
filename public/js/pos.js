
$(function () {
    $('#to_exchange_currency').selectpicker('refresh');
    $('#from_exchange_currency').selectpicker('refresh');
    $('#non_member_create').attr('disabled',true);
    // var s;
    //     alert('ssss')
    //     $('.from_note_class').each(function () {
    //         console.log('a');
    //         console.log('aaaaaaaaaaa' +$(this).val());
    //         // s+=$(this).val();
    //     });
    // $('.from_note_class').on('keyup input propertychange paste change',function () {
    //     var self=this;
    //     alert(self);
    // });

});
var obj;

var r;
var sum=0;
var sum1=0;


function total_currency_value(group_id,sheet,note) {
// console.log(this);
//     $(this).on('keyup    ',function () {

    // alert($(this).val().toString());
        $.get({
            data: { "id": group_id },
            url: 'total_currency_value',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                // if($.trim(sheet) === '')
                // {
                //     sheet=0;
                //     r=sum-((Number(note)* sheet) * data.value);
                //     console.log('r '+r);
                //     $('.total_value').html(r);
                // }
                // else
                // {
                if(data.value === "Myanmar Kyat")
                {
                    data.value=1;
                    sum += (Number(note)* sheet) * data.value ;
                    console.log('sum '+sum);
                    $('.total_value').html(sum);
                }
                else
                {
                    sum += (Number(note)* sheet) * data.value ;
                    // console.log('sum '+sum);
                    $('.total_value').html(sum);
                }

                // }

            }
        });

    // });


}

function to_total_currency_value(group_id,sheet,note) {
    // alert(sheet);
    $.get({
        data: {"id": group_id},
        url: 'total_currency_value',
        dataType: 'json',
        success: function (data) {
            console.log(data);
            if(data.value === "Myanmar Kyat"){
                sum1 += (Number(note)* sheet)  ;
                // console.log('sum '+sum);
                $('.total_value1').html(sum1);
            }
            else
            {
                // console.log(sheet);
                // alert(sheet)
                sum1+= ( Number(note)*Number(sheet)) * data.value ;
                console.log('group_value '+data.value);
                console.log('to currency_sum '+sum1);
                console.log('to sheet  '+sheet);
                $('.total_value1').html(sum1);
            }
        }
    });
}
// *********************************************************************************
// $(function(){
//
//     function getVals(){
//         var n = 0;
//         $("input[name='prices[]']").each(function(i, e){
//             n += +$(e).val();
//         });
//         return n;
//     }
//     $("input[name='prices[]']").change(function(){
//         $('#out').html(getVals());
//     });
//
// });

// *****************************88**************************88888888
// array=[];
// note=[];
// notes_id=[];
// $('.from_group_id').each(function (){
//     var gp=Number($(this).val());
//     array.push(gp);
// });
// groups=$.unique(array);
// $('.from_note_id').each(function (){
//     var n=$(this).val();
//     notes_id.push(n);
// });
//
// $('.from_note_class').each(function () {
//     var val=Number($(this).val());
//     note.push(val);
// });
//
// const array_combine = (keys, values) => {
//     const result = {};
//
//     for (const [index, key] of keys.entries()) {
//         if(values[index]===0)
//         {
//             result[key]=0;
//         }
//         else
//         result[key] = values[index];
//
//     }
//     return result;
// };
// console.log('Buy value '+ getValue(group_id));

// group_note=(array_combine(notes_id,groups));
// note_array=(array_combine(notes_id,note));
// console.log(group_note);
// $.each(group_note,function (key,value) {
// alert($(this.val());



