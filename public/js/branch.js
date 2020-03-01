$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#editMessage').hide();
    $('#createMessage').hide();
    $('#branchForm').click(function (event) {
        var name=$('#name').val();
        var phone_number=$('#phone_number').val();
        var address=$('#address').val();
        var branch_type=$('#branch_type').val();
        event.preventDefault();
        $.ajax({
            'url':'/branch/store',
            'type':'POST',
            data:{
                name:name,
                phone_number:phone_number,
                address:address,
                branch_type:branch_type,
            },
            success:function (data) {
                if(data.is_success==false){
                    if(data.errors.name){
                        $( '#name_error' ).html( data.errors.name[0] );
                    }
                    if(data.errors.phone_number){
                        $( '#phone_number_error' ).html( data.errors.phone_number[0] );
                    }
                    if(data.errors.address){
                        $( '#address_error' ).html( data.errors.address[0] );
                    }
                    if(data.errors.branch_type){
                        $( '#branch_type_error' ).html( data.errors.branch_type[0] );
                    }
                }else if(data.is_success==true){
                    $('#createMessage').show();
                    $( "#success").html(data.message);
                    setTimeout(function() {
                        $('#branch_create').modal('hide');
                        setTimeout(location.reload.bind(location));
                    }, 1000);
                }
            }
        });
    });
    $('#branchForm1').click(function (event) {
        var name=$('#name1').val();
        var id=$('#id').val();
        var phone_number=$('#phone_number1').val();
        var address=$('#address1').val();
        var branch_type=$('#branch_type1').val();
        event.preventDefault();
        $.ajax({
            'url':'/branch/update',
            'type':'POST',
            data:{
                id:id,
                name:name,
                phone_number:phone_number,
                address:address,
                branch_type:branch_type,
            },
            success:function (data) {
                if(data.is_success==false){
                    if(data.errors.name){
                        $( '#name_error1' ).html( data.errors.name[0] );
                    }
                    if(data.errors.phone_number){
                        $( '#phone_number_error1' ).html( data.errors.phone_number[0] );
                    }
                    if(data.errors.address){
                        $( '#address_error1' ).html( data.errors.address[0] );
                    }
                    if(data.errors.branch_type){
                        $( '#branch_type_error1' ).html( data.errors.branch_type[0] );
                    }
                }else if(data.is_success==true){
                    $('#editMessage').show();
                    $( "#success").html(data.message);
                    setTimeout(function() {
                        $('#branch_edit').modal('hide');
                        setTimeout(location.reload.bind(location));
                    }, 1000);
                }
            }
        });
    });
});

function editBranch(branch_id){
    $.ajax({
        url:'branch/'+branch_id+'/edit',
        type:'get',
        dataType:'json',
        success:function (data) {
            $('#id').val(data.id);
            $('#name1').val(data.name);
            $('#address1').val(data.address);
            $('#phone_number1').val(data.phone_number);
            $('#branch_type1 option').prop('selected',false);
            $('#branch_type1 option[value="'+data.branch_type_id+'"]').prop('selected',true);
            $('#branch_type1').selectpicker('refresh');
            $('#branch_edit').modal('show');
        }
    })
}
