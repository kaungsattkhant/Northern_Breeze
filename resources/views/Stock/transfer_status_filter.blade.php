@foreach($transfers as $transfer)
    <tr>
        <td scope="row" class="table-row-m fontsize-mount2 border-top-0">{{$transfer->currency->name}}</td>
        <td class="table-row-m fontsize-mount2 border-top-0">{{$transfer->total_transfer_value}}</td>
        <td class="table-row-m text-info border-top-0">{{$transfer->transfer_status}}</td>
        <td class="table-row-m border-top-0"><a href="#" class="text-a-mount" onclick="detail({{$transfer->id}})">Detail</a></td>
        {{--                         <td class="table-row-m border-top-0"><a href="#" class="text-a-mount" data-target="#detail" data-toggle="modal">Detail</a></td>--}}
    </tr>
@endforeach
