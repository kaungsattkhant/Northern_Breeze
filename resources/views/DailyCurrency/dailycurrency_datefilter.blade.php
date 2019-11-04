{{--<tbody>--}}
@foreach($buy as $b)

    <tr>
        <td scope="row" class="table-row-m fontsize-mount2">{{$b->group->currency->name}}</td>

        <td scope="row" class="table-row-m fontsize-mount2">{{$b->group->name}}</td>
        <td class="table-row-m fontsize-mount2">
            @foreach($b->group->notes as $note)
                {{$note->name}}
            @endforeach
        </td>
        <td class="table-row-m text-info">
            {{$b->value}}
        </td>
        <td class="table-row-m text-info">
            {{--                            {{$b->value}}--}}
            {{--                        @foreach($group->selling_price as $sp)--}}
            {{--                            @if($sp->date_time==)--}}

            {{--                            {{$sp->value}}--}}
            {{--                            <br>--}}
            {{--                        @endforeach--}}
        </td>
        <td class="table-row-m "><a href="#" class="text-a-mount" data-toggle="modal" data-target="#detail">Detail</a></td>
    </tr>
{{--                <tr>--}}
{{--                    <td scope="row" class="table-row-m fontsize-mount2">U.S Dollar</td>--}}
{{--                    <td class="table-row-m fontsize-mount2">1000000</td>--}}
{{--                    <td class="table-row-m text-danger">OUt</td>--}}
{{--                    <td class="table-row-m "><a href="#" class="text-a-mount" data-toggle="modal" data-target="#detail">Detail</a></td>--}}
{{--                </tr>--}}
@endforeach
{{--</tbody>--}}
