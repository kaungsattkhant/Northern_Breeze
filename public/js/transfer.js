$(function() {


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

    });
    });

    function transfer_detail($transfer_id)
    {
        // alert($transfer_id);
        $.ajax({
            url:'stock/'+$transfer_id+'/detail',
            type:'get',
            success:function (data) {
                // console.log(data);
                $('#detail').modal('show');
                $('div #detail_modal').html(data);
            }

        });
    }

// });




