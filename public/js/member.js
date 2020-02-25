$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#editMessage').hide();
    $('#createMessage').hide();

    $('#memberForm').click( function(event) {
        var name = $("#name").val();
        var company=$('#company').val();
        var address= $("#address").val();
        // var dob= $("#dob").val();
        var years=$('#years').val();
        var days=$('#days').val();
        var months=$('#months').val();
        var phone_number=$('#phone_number').val();
        var email=$('#email').val();
        // var state=$('#state').val();
        var exchange_type=$('#exchange_type').val();
        var member_type=$('#member_type').val();
        var points=$('#points').val();
        // $('#company-error').html("");
        // $('#name-error').html("");
        // $('#address-error').html("");
        // $('#phone_number-error').html("");
        // $('#email-error').html("");
        // $('#dob-error').html("");
        // $('#dob-error').html("");
        // $('#dob-error').html("");
        // $('#dob-error').html("");
        event.preventDefault();
        $.ajax({
            url:'/member/store',
            type:'POST',
            data:{
                name:name,
                email:email,
                company:company,
                address:address,
                days:days,
                months:months,
                years:years,
                phone_number:phone_number,
                exchange_type:exchange_type,
                member_type:member_type,
                points:points,
            },
            success:function(data)
            {
                console.log(data);
                if(data.errors)
                {
                    if(data.errors.name){
                        $( '#name_error' ).html( data.errors.name[0] );
                    }
                    if(data.errors.email){
                        $( '#email_error' ).html( data.errors.email[0] );
                    }
                    if(data.errors.company){
                        $( '#company_error' ).html( data.errors.company[0] );
                    }
                    if(data.errors.phone_number){
                        $( '#phone_number_error' ).html( data.errors.phone_number[0] );
                    }
                    if(data.errors.exchange_type){
                        $( '#exchange_type_error' ).html( data.errors.exchange_type[0] );
                    }
                    if(data.errors.member_type){
                        $( '#member_type_error' ).html( data.errors.member_type[0] );
                    }
                    if(data.errors.points){
                        $( '#points_error' ).html( data.errors.points[0]);
                    }
                    if(data.errors.address){
                        $( '#address-error' ).html( data.errors.address[0] );
                    }
                    if(data.errors.years || data.errors.months || data.errors.days){
                        $('#date_error').html('Data of birth is required');
                    }
                }
                else if(data.success==true)
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
    $('#memberForm1').click(function(event){
        var email = $("#email1").val();
        var name = $("#name1").val();
        var phone_number=$('#phone_number1').val();
        var company=$('#company1').val();
        var address=$('#address1').val();
        var months=$('#Emonths').val();
        var years=$('#Eyears').val();
        var days=$('#Edays').val();
        var id=$('#id').val();
        var exchange_type=$('#exchange_type1').val();
        var member_type=$('#member_type1').val();
        var points=$('#points1').val();

        // $('#phone_number-error1').html("");
        // $('#show-success').html("");
        // $('#email-error1').html("");
        event.preventDefault();
        $.ajax({
            url:'member/update',
            type:'POST',
            data:{
                id:id,
                name:name,
                email:email,
                company:company,
                address:address,
                days:days,
                months:months,
                years:years,
                phone_number:phone_number,
                exchange_type:exchange_type,
                member_type:member_type,
                points:points,
            },
            success:function(data)
            {
                if(data.errors)
                {
                    if(data.errors.name){
                        $( '#name_error1' ).html( data.errors.name[0] );
                    }
                    if(data.errors.email){
                        $( '#email_error1' ).html( data.errors.email[0] );
                    }
                    if(data.errors.company){
                        $( '#company_error1' ).html( data.errors.company[0] );
                    }
                    if(data.errors.phone_number){
                        $( '#phone_number_error1' ).html( data.errors.phone_number[0] );
                    }
                    if(data.errors.exchange_type){
                        $( '#exchange_type_error1' ).html( data.errors.exchange_type[0] );
                    }
                    if(data.errors.member_type){
                        $( '#member_type_error1' ).html( data.errors.member_type[0] );
                    }
                    if(data.errors.points){
                        $( '#points_error1' ).html( data.errors.points[0] );
                    }
                    if(data.errors.address){
                        $( '#address-error1' ).html( data.errors.address[0] );
                    }
                    if(data.errors.years || data.errors.months || data.errors.days){
                        $('#date_error1').html('Data of birth is required');
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
    $('.amount_of_point').keyup(function() {
        // alert($('.member_type_select').val());
        $( '#points_error' ).html(' Point is invalid');
        var points=this.value;
        var value=$('#member_type').val();
        if(value!=null){
            $('#member_type_error').hide();
            if(value==1){
                $('.amount_of_point').attr('min','0');
                $('.amount_of_point').attr('max','999');
                if(points>=0 && points<= 999){
                    $('#points_error').hide();

                }else{
                    $('#points_error').show();

                }
            }
            else if(value==2){
                $('.amount_of_point').attr('min','1000');
                $('.amount_of_point').attr('max','2999');
                if(points>=1000 && points<= 2999){
                    $('#points_error').hide();

                }else{
                    $('#points_error').show();

                }
            }
            else if(value==3){
                $('.amount_of_point').attr('min','3000');
                $('.amount_of_point').attr('max','4999');
                if(points>=3000 && points<= 4999){
                    $('#points_error').hide();

                }else{
                    $('#points_error').show();

                }
            }
            else if(value==4){
                $('.amount_of_point').attr('min','5000');
                $('.amount_of_point').attr('max','8999');
                if(points>=5000 && points<= 8999){
                    $('#points_error').hide();

                }else{
                    $('#points_error').show();

                }
            }
            else if(value==5){
                // alert(value);
                $('.amount_of_point').attr('min','9000');
                if(points<9000){
                    $('#points_error').show();
                }else{
                    $('#points_error').hide();

                }
            }
        }else{
            $('#member_type_error').html('Please choose member_type');
        }

    });
});
function deleteMember($id)
{
    // alert($id);
    $('#delete_id').val($id);
    $('#destroy').modal('show');
}
function editMember($id)
{
    $.ajax({
        url:'member/'+$id+'/edit',
        date:'get',
        dataType:'json',
        success:function (data) {
            var dob=data.date_of_birth;
            var years=dob.slice(0,4);
            var months=parseInt(dob.slice(5,7));
            var days=parseInt(dob.slice(8,10));
            $('#id').val(data.id);
            $('#name1').val(data.name);
            $('#company1').val(data.company);
            $('#address1').val(data.address);
            $('#phone_number1').val(data.phone_number);
            $('#email1').val(data.email);
            $('#points1').val(data.points);
            $('#member_type1 option').prop('selected',false);
            $('#member_type1 option[value="'+data.member_type_id+'"]').prop('selected',true);
            $('#exchange_type1 option').prop('selected',false);
            $('#exchange_type1 option[value="'+data.exchange_type_id+'"]').prop('selected',true);
            $('#Eyears option').prop('selected',false);
            $('#Eyears option[value="'+years+'"]').prop('selected',true);
            $('#Emonths option').prop('selected',false);
            $('#Emonths option[value="'+months+'"]').prop('selected',true);
            $('#Edays option').prop('selected',false);
            $('#Edays option[value="'+days+'"]').prop('selected',true);
            $('#member_type1').selectpicker('refresh');
            $('#exchange_type1').selectpicker('refresh');

            $('#edit').modal('show');
        }
    })
}
