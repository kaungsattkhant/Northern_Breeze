@foreach($staff as $st)
    <tr>
        {{--                        <td class="table-row-m fontsize-mount">1</td>--}}

        <td scope="row" class="table-row-m fontsize-mount">{{$st->name}}</td>
        <td class="table-row-m fontsize-mount">{{$st->role->name}}</td>
        <td class="table-row-m text-center">
            <a>
                <i class="far fa-edit mr-3 text-info"  onclick="edit({{$st->id}})"></i>
            </a>
            <a href="#" data-toggle="modal" data-target="#Delete">
                <i class="far fa-trash-alt text-danger"></i>
            </a>
        </td>
    </tr>
@endforeach
