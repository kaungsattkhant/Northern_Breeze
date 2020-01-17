function edit($id)
{
    $.ajax({
        url: "staff/" + $id + "/edit",
        data: "get",
        dataType: "json",
        success: function (data) {
            // console.log('success');
            $('#id').val(data.id);
            $('#email1').val(data.email);
            $('#name1').val(data.name);
            // $('#role1 option').prop('selected',false);
            // $('#role1 option[value="'+data.role_id+'"]' ).prop('selected','selected');
            // $('#branch1 option').prop('selected',false);
            // $('#branch1 option[value="'+data.branch_id+'"]' ).prop('selected','selected');
            $('select[name=role]').val(data.role_id);
            $('select[name=branch]').val(data.branch_id);


            // $('#role1').selectpicker('refresh');
            // $('#branch1').selectpicker('refresh');

            $('#edit').modal('show');
        }
    });
}

