@foreach($vs as $key=>$v)

        <tr>
            <td scope="row" class="table-row-m fontsize-mount2">{{$v->date}}</td>


            <td class="table-row-m text-info">
                {{$v->sell_value}}
            </td>
            <td class="table-row-m text-info">
                {{$v->buy_value}}
            </td>
        </tr>
@endforeach
