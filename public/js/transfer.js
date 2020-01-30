$(function() {

    $(function(){
        $("#stock a").addClass("active-si");

        $("#stock").addClass("active2");

    });
    $('#branch').on('change',function () {
        var branch=$(this).val();
        $.ajax({
            url:'stock/'+branch+'/branch_filter',
            type:'get',
            success:function(data)
            {
                $('table #stock_transfer').html(data);
            }
        });
    });

    $('#transfer_status_filter').on('change',function(){

        var value=$(this).val();
        var branch=$('#branch').val();
        if(branch!=null)
        {
            $.ajax({
                url:'stock/'+value+'/transfer_status_filter',
                type:'get',
                success:function(data)
                {
                    $('table #stock_transfer').html(data);
                }
            });
        }
        // $.get({
        //     data: {
        //         "id": group_id,
        //         ""
        //     } ,
        //     url: 'total_currency_value',
        //     dataType: 'json',
        //     success: function (data) {
        //
        //     }
        //  });
    });
    function transfer_detail($transfer_id)
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


});




