$(document).ready(function(){
    $('#member_filter').on('change',function () {
        var value=$(this).val();
        // alert(value);
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
});
