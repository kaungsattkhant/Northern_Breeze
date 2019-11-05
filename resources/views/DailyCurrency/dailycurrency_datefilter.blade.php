{{--<tbody>--}}
@foreach($groups as $group)
    <tr>
        <td scope="row" class="table-row-m fontsize-mount2">{{$group->currency->name}}</td>

        <td scope="row" class="table-row-m fontsize-mount2">{{$group->name}}</td>
        <td class="table-row-m fontsize-mount2">
            @foreach($group->notes as $note)
                {{$note->name}}
            @endforeach
        </td>

        <td class="table-row-m text-info">
            {{$group->lastest_sell_value}}
        </td>
        <td class="table-row-m text-info">
            {{$group->lastest_buy_value}}
        </td>
        <td class="table-row-m "><a href="#" class="text-a-mount" onclick="dailyDetail({{$group->currency->id}},{{$group->id}})" >Detail</a></td>
    </tr>
@endforeach
{{--</tbody>--}}
