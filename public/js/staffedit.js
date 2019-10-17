function edit($id)
{
    $.ajax({
        url: "staff/" + $id + "/edit",
        data: "get",
        dataType: "json",
        success: function (data) {
            console.log(data);
            $('#id').val(data.id);
            $('#email1').val(data.email);
            $('#name1').val(data.name);
            $('#role1 option').prop('selected' ,false);
            $('#role1 option[value="'+data.role_id+'"]').prop('selected',true);
            $('#edit').modal('show');
        }
    });
}
