$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#daily_currency_filter').on('change',function(){
        var currency_id=$(this).val();
        // alert(currency_id);
        $.ajax({
           url:currency_id+'/filter',
            type:'get',
            success:function(data)
            {
                // console.log(data);
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

function dailyDetail($currency_id,$group_id) {
    $.ajax({
        url:'daily_currency/'+$currency_id+'/detail/'+$group_id,
        type:'get',
        // dataType: "json",

        success:function (data) {
            // console.log(data);
            // $.each(function (data) {
            //     "<tr><th scope='col class='border-bottom-0 border-top-0 fontsize-mount6'>"+ data.name +  "</th>"
            //
            // });
            // console.log(data);
            $('#daily_detail').modal('show');

            $('table #dailycurrency_detail').html(data);
        },
    });
}
