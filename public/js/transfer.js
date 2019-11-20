// $(function() {
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });

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

        })
    }
// });




