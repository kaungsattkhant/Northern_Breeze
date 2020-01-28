<div id="group" class="">

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
                <p class="text-color-mount fontsize-mount2 pt-1 text-center for-quote">

                    @foreach($group->notes as $note)
                        {{$note->name}},
                    @endforeach

                </p>
            </div>
        @endforeach


    </div>

    <div class="row pt-3  pl-1">
        <div class="col-4">
            <label class="pl-3 text-color-mount fontsize-mount pr-4 my-auto">Selling Value</label>
        </div>

        @foreach($groups as $group)

            @php
                use App\Model\Currency;$cu=Currency::where('name','United States dollar')->first()
            @endphp
            @if($group->currency_id == $cu->id)
                <div class="col">
                    @php
                        use App\Model\Classification;$classifications=Classification::all();
                    @endphp
                    @foreach($classifications as $key=>$classification)
                        <input type="hidden" name="selling_class_group_id[]" value="{{$group->id}}">

                        <div class="col-item-mini text-color-mount fontsize-mount2">
                            <input type="text" placeholder="{{$classification->name}}" name="selling_classification[]"
                                   class="pl-3" style="width: 100%;border: none;background-color: transparent">
                            @if($key%2 !=0)
                                <br>
                            @endif
                            <input type="hidden" name="selling_classification_id[]" value="{{$classification->id}}">
                        </div>
                    @endforeach

                </div>
            @else
                <div class="col col-item ">
                    <input type="text" placeholder="" name="selling_price[]" class="text-center text-box-mount">

                </div>
            @endif
        @endforeach

    </div>
    <div class="row mb-3 pl-1">
        <div class="col-4">
        </div>
    </div>
    <div class="row mb-1 pl-1 pt-3 pb-5">
        <div class="col-4">
            <label class="pl-3 text-color-mount fontsize-mount pr-4 mt-3">Buying Value</label>
        </div>
        @foreach($groups as $group)
            <div class="col mb-4">
                <div class="row">

                    @php
                        use App\Model\Currency;$cu=Currency::where('name','United States dollar')->first()
                    @endphp
                    @if($group->currency_id == $cu->id)
                        <div class="col">
                            @php
                                use App\Model\Classification;$classifications=Classification::all();
                            @endphp
                            @foreach($classifications as $classification)
                                <input type="hidden" name="buying_class_group_id[]" value="{{$group->id}}">

                                <div class="col-item-mini text-color-mount fontsize-mount2">
                                    <input type="text" placeholder="{{$classification->name}}"
                                           name="buying_classification[]" class="pl-3"
                                           style="width: 100%;border: none;background-color: transparent">

                                    <input type="hidden" name="buying_classification_id[]"
                                           value="{{$classification->id}}">
                                </div>
                            @endforeach

                        </div>
                    @else
                        <div class="col col-item2">
                            <input type="text" placeholder="" name="buying_price[]"
                                   class="text-center text-black text-box-mount">

                        </div>
                    @endif

                </div>
            </div>
        @endforeach
    </div>

</div>
