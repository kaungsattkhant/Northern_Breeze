$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // $('#admin_edit').hide();
    // $('#admin_create').hide();

    $('#submitForm').click( function(event) {
        alert('success')
        var password = $("#password").val();
        var name=$('#name').val();
        var password_confirmation= $("#password_confirmation").val();
        var role=$('#role').val();
        $('#role-error').html("");
        $('#name-error').html("");
        $('#email-error').html("");
        $('#password-error').html("");
        event.preventDefault();
        $.ajax({
            url:'/admin/store',
            type:'POST',
            data:{
                name:name,
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
                        $( '#name1-error' ).html( data.errors.name[0] );
                    }
                    if(data.errors.role){
                        $( '#role-error' ).html( data.errors.role[0] );
                    }
                    if(data.errors.password){
                        $( '#password-error' ).html( data.errors.password[0] );
                    }
                    if(data.errors.password_confirmation){
                        $( '#password_confirmation-error' ).html( data.errors.password_confirmation[0] );
                    }
                }
                if(data.success==true)
                {
                    $('#admin_create').show();
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
        var phone_number=$('#phone_number1').val();
        var id=$('#id').val();
        $('#phone_number-error1').html("");
        $('#show-success').html("");
        $('#email-error1').html("");
        event.preventDefault();
        $.ajax({
            url:'admin/update',
            type:'POST',
            data:{
                id:id,
                name:name,
                email:email,
                phone_number:phone_number,
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
                    if(data.errors.phone_number){
                        $( '#phone_number-error1' ).html( data.errors.phone_number[0] );
                    }
                }
                if(data.success==true)
                {
                    // $('#editAdmin').delay(300).modal('toggle');
                    $('#admin_edit').show();
                    $( "#success1" ).html(data.message);
                    setTimeout(function() {
                        $('#editAdmin').modal('hide');
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
            url:'admin/change_pass',
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
