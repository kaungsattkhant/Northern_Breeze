$(document).ready(function(){
    $('#member_filter').on('change',function () {
        var value=$(this).val();
        $.ajax({
            url:'member/'+value+'/member_type_filter',
            type:'get',
            success:function(htmlcode)
            {
                console.log(htmlcode);
                $('#myTable tbody').html(htmlcode);
            }
        })
    });
    $('#staff_filter').on('change',function(){

        var value=$(this).val();
        $.ajax({
            url:'staff/'+value+'/role_filter',
            type:'get',
            success:function(data)
            {
                console.log(data);
                $('#myTable tbody').html(
                    data
                    // "<tr>"+data.name+ "</tr>"
                );

            }
        })
    });

    $('#stock_currency_filter').on('change',function(){
        var value=$(this).val();
        $.ajax({
            url:+value+'/stock_currency_filter',
            type:'get',
            success:function(data)
            {
                console.log(data);
                $('div #stock_table_filter').html(data);

            }
        })
    });
    // *********************************************************************************************************

    // *******************************************POS Non_member *******************************************


    $('#from_exchange_currency').on('change',function () {
        var id=$(this).val();

        // alert(id);
        $.ajax({
            url:+id+'/non_member_from_exchange_filter',
            type:'get',
            success:function (data) {
                $('table #from_exchange_table').html(data);
            }
        });
    });

    $('#to_exchange_currency').on('change',function () {
        $('#non_member_create').attr('disabled',false);
        // $('#non_member_create').submit();
        var id=$(this).val();
        $.ajax({
            url:+id+'/non_member_to_exchange_filter',
            type:'get',
            success:function (data) {
                $('table #to_exchange_table').html(data);
            }
        });
    });

    // $('.note').on('change',function () {
    //     console.log('sss');
    //     alert('succe');
    // });
    // ********************************************End POS********************************************

});
