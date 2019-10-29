$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // $("#staff_filter").select2();

    $('#editMessage').hide();
    $('#createMessage').hide();

    $('#staffSubmit').click( function(event) {
        var password = $('#password').val();
        var password_confirmation = $('#password_confirmation').val();
        var email=$('#email').val();
        var name=$('#name').val();
        var role=$('#role').val();

        $('#role-error').html("");
        $('#name-error').html("");
        $('#email-error').html("");
        $('#password-error').html("");
        $('#password_confirmation-error').html("");
        event.preventDefault();
        $.ajax({
            url:'/staff/store',
            type:'POST',
            data:{
                name:name,
                email:email,
                password:password,
                password_confirmation:password_confirmation,
                role:role,
            },
            success:function(data)
            {
                console.log(data);
                if(data.errors)
                {
                    if(data.errors.name){
                        $( '#name-error' ).html( data.errors.name[0] );
                    }
                    if(data.errors.role){
                        $( '#role-error' ).html( data.errors.role[0] );
                    }
                    if(data.errors.email){
                        $( '#email-error' ).html( data.errors.email[0] );
                    }
                    if(data.errors.password){
                        $( '#password-error' ).html( data.errors.password[0]);
                    }
                    if(data.errors.password_confirmation){
                        $( '#password_confirmation-error' ).html( data.errors.password_confirmation[0] );
                    }
                }
                if(data.success==true)
                {
                    $('#createMessage').show();
                    $( "#success").html(data.message);
                    setTimeout(function() {
                        $('#create').modal('hide');
                        setTimeout(location.reload.bind(location));
                    }, 1000);
                }
            },
        });
    });
    $('#submitForm1').click(function(event){
        var email = $("#email1").val();
        var name = $("#name1").val();
        var role=$('#role1').val();
        // var password = $("#password").val();
        var id=$('#id').val();
        $('#phone_number-error1').html("");
        $('#name1').html("");
        $('#show-success').html("");
        $('#email-error1').html("");
        event.preventDefault();
        $.ajax({
            url:'staff/update',
            type:'POST',
            data:{
                id:id,
                name:name,
                email:email,
                role:role,
            },
            success:function(data)
            {
                if(data.errors)
                {
                    if(data.errors.name){
                        $( '#name-error1' ).html( data.errors.name[0] );
                    }
                    if(data.errors.email){
                        $( '#email-error1' ).html( data.errors.email[0] );
                    }
                    if(data.errors.role){
                        $( '#role-error1' ).html( data.errors.role[0] );
                    }
                }
                if(data.success==true)
                {
                    // $('#editAdmin').delay(300).modal('toggle');
                    $('#editMessage').show();
                    $( "#success1" ).html(data.message);
                    setTimeout(function() {
                        $('#edit').modal('hide');
                        setTimeout(location.reload.bind(location));
                    }, 1000);
                }
            },
        });
    });

    $('#admin_changePass').click(function(event){
        var id=$('#changePasswordId').val();
        var password=$('#password2').val();
        var password_confirmation=$('#password_confirmation2').val();
        $('#password_error2').html("");
        $('#password_confirmation_error2').html("");
        event.preventDefault();
        $.ajax({
            url:'staff/change_pass',
            type:'POST',
            data:{
                id:id,
                password:password,
                password_confirmation:password_confirmation,
            },
            success:function(data)
            {
                console.log(data);
                if(data.errors)
                {
                    if(data.errors.password){
                        $( '#password_error2' ).html( data.errors.password[0] );
                    }
                    if(data.errors.password_confirmation){
                        $( '#password_confirmation_error2').html( data.errors.password_confirmation[0] );
                    }
                }

                if(data.success==true)
                {
                    $('#changepass').modal('toggle');
                    location.reload();
                }

            },
        });

    });

});
function deleteStaff($id) {
    $('#delete_id').val($id);
    $('#delete').modal('show');
}