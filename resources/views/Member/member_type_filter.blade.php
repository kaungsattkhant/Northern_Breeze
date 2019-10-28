@foreach($members as $member)
    <tr>
        <td scope="row" class="table-row-m"><a href="member-data.html" class="text-decoration-none text-dark fontsize-mount2">{{$member->name}}</a></td>
        <td class="table-row-m fontsize-mount2">{{$member->member_type->name}}</td>
        {{--                    <td class="table-row-m fontsize-mount2">{{$member->}}</td>--}}
        <td class="table-row-m fontsize-mount2">{{$member->phone_number}}</td>
        <td class="table-row-m fontsize-mount2">
            <a>
                <i class="far fa-edit mr-3 text-info" onclick="editMember({{$member->id}})"></i>
            </a>
            <a href="#" data-toggle="modal" data-target="#destroy">
                <i class="far fa-trash-alt text-danger"></i>
            </a>
        </td>
    </tr>
    @endforeach
