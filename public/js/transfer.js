$(function() {
    // alert('aa');
    // $(function(){
        $("#stock a").addClass("active-si");

        $("#stock").addClass("active2");
    //
    // });
    $('#transfer_filter').on('click',function () {
        branch=$('#branch').val();
        status=$('#transfer_status_filter').val();
        date=$('.transfer_date').val();
        if(branch ==null){
            alert(' Please choose branch');
        }else{
            $.get({
                url:'/stock/transfer_filter',
                data: {
                    branch: branch,
                    status: status,
                    date: date,
                       },
                    // type: 'json',
                    success:function(response)
                    {
                        // console.log('data');
                        $('table #stock_transfer').html(response);
                    }

            });
        }
    });
    // $('#branch').on('change',function () {
    //     var branch=$(this).val();
    //     $.ajax({
    //         url:'stock/'+branch+'/branch_filter',
    //         type:'get',
    //         success:function(data)
    //         {
    //             $('table #stock_transfer').html(data);
    //         }
    //     });
    // });
    //
    // $('#transfer_status_filter').on('change',function(){
    //
    //     var value=$(this).val();
    //     var branch=$('#branch').val();
    //     if(branch!=null)
    //     {
    //         $.ajax({
    //             url:'stock/'+value+'/transfer_status_filter',
    //             type:'get',
    //             success:function(data)
    //             {
    //                 $('table #stock_transfer').html(data);
    //             }
    //         });
    //     }
    //     // $.get({
    //     //     data: {
    //     //         "id": group_id,
    //     //         ""
    //     //     } ,
    //     //     url: 'total_currency_value',
    //     //     dataType: 'json',
    //     //     success: function (data) {
    //     //
    //     //     }
    //     //  });
    // });



});
function detail($transfer_id)
{
    $.ajax({
        url:'stock/'+$transfer_id+'/detail',
        type:'get',
        success:function (data) {
            $('#detail').modal('show');
            $('div #detail_modal').html(data);
        }
    });
}




