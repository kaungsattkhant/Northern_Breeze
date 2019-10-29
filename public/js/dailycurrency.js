$(function(){
    $('#daily_currency_filter').on('change',function(){
        var currency_id=$(this).val();
        $.ajax({
           url:'daily_currency/'+currency_id+'/filter',
            type:'get',
            success:function(data)
            {
                console.log(data);
                $('#daily #group').html(data);

            }
        });
    });
});
