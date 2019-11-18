


    <div class="col">
        <table class="table border-0 bg-white box-shadow-mount border-tab-radius-mount" id="stock_table_filter">
            <tbody class="rounded-table-mount" >
            @foreach($stock_notes as $note)
                <tr>
                    <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">{{ $note->name}}</td>
                    <input type="hidden" name="note_id[]" value="{{$note->id}}">
                    <td class="text-right border-top-0 pt-4">
                        <p class="text-color-mount fontsize-mount2">{{$note->total_sheet}}</p>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
        <div class="div-p-mount2">
            <p>Total : {{$total}} </p>

        </div>
    </div>
    <div class="col pt-4 mt-4">
        <table class="table border-0 bg-white box-shadow-mount rounded-table-mount mt-2 pb-5">
            <tbody class="rounded-table-mount ">
            @foreach($stock_notes as $note)
            <tr>
                <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">{{$note->name}} </td>
                <td class="text-right border-top-0 pt-4 pb-4">
                    <input type="text" name=notes[] class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="">
                    <input type="hidden" name="group[]" value="{{$note->group_id}}">
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
        <div class="div-p-mount2">
            <p>Total :</p>
        </div>

    </div>

