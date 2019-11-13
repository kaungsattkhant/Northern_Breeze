    <div class="row pl-1 pt-5">
        <div class="col-4">
            <label class="pl-3 text-color-mount fontsize-mount pr-4 my-auto">Group Name</label>
        </div>
        @foreach($groups as $group)

        <div class="col col-item ">
            <p class="text-color-mount fontsize-mount17 pt-1">{{$group->name}}</p>
            <input type="hidden" name="group_id[]" value="{{$group->id}}">
        </div>
        @endforeach
    </div>
    <div class="row mb-4 pl-1">
        <div class="col-4">
        </div>
        @foreach($groups as $group)
        <div class="col">
            <p class="text-color-mount fontsize-mount2 pt-1 text-center">

                @foreach($group->notes as $note)
                    {{$note->name}},
                    @endforeach

            </p>
        </div>
        @endforeach


    </div>


{{--                                                                          selling value--}}
    <div class="row pt-3  pl-1">
        <div class="col-4">
            <label class="pl-3 text-color-mount fontsize-mount pr-4 my-auto">Selling Value</label>
        </div>

        @foreach($groups as $group)

            <div class="col col-item ">
                <input type="text" placeholder="Price for group" name="selling_price[]" class="text-center text-box-mount">
            </div>
        @endforeach

    </div>

{{--                                            selling value 2nd role--}}
    <div class="row mb-3 pl-1">
        <div class="col-4">

        </div>

    </div>
{{--                                                            buying value--}}
    <div class="row mb-1 pl-1 pt-3 pb-5">
        <div class="col-4">
            <label class="pl-3 text-color-mount fontsize-mount pr-4 mt-3">Buying Value</label>
        </div>
        @foreach($groups as $group)
            <div class="col mb-4">
                <div class="row">
                    <div class="col col-item2">
                        {{--                                    <p class="text-color-mount fontsize-mount17 pt-1">10000</p>--}}
{{--                        <input type="text" placeholder=""  class="text-center text-box-mount fontsize-mount17">--}}
                        <input type="text" placeholder="2000"  name="buying_price[]" class="text-center text-black text-box-mount">

                        <input type="hidden" name="class_group_id" value="{{$group->id}}">
                    </div>
                    @if($group->currency_id == 18)
                        <div class="col">
                            @php
                                $classifications=\App\Model\Classification::all();
                            @endphp
                            @foreach($classifications as $classification)
                                <div class="col-item-mini text-color-mount fontsize-mount2">
                                    <input type="text" placeholder="{{$classification->name}}" name="classification[]" class="pl-3" style="width: 100%;border: none;background-color: transparent">

                                    <input type="hidden" name="classification_id[]" value="{{$classification->id}}">
                                </div>
                            @endforeach

                        </div>
                        @endif

                </div>
            </div>
            @endforeach
    </div>

