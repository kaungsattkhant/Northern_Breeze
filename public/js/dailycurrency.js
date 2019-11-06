$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#create_button').hide();

    $('#daily_currency_filter').on('change',function(){
        var currency_id=$(this).val();
        // alert(currency_id);
        $.ajax({
           url:currency_id+'/filter',
            type:'get',
            success:function(data)
            {
                // console.log(data);
                $('#create_button').fadeIn();

                $('#daily #group').html(data);
            }
        });
    });

    $('#currency_datefilter').on('click',function () {
        var date=$('#currency_date').val();
        $.ajax({
            url:'daily_currency/datefilter',
            type:'post',
            data:{
                date:date,
            },
            success:function(data)
            {
                // console.log(date);
                $('table #dailycurrency_table').html(data);
            }
        });
    });



});

function dailyDetail($group_id,$detail_id) {
    $.ajax({
        url:'daily_currency/'+$group_id+'/detail/'+$detail_id,
        type:'get',
        success:function (data) {

            $('#daily_detail').modal('show');

            $('table #dailycurrency_detail').html(data);
        },
    });
}


