    <div class="row pl-1">
        <div class="col-4">
            <label class="pl-3 text-color-mount fontsize-mount pr-4 my-auto">Group Name</label>
        </div>
        @foreach($groups as $group)

        <div class="col col-item ">
            <p class="text-color-mount fontsize-mount17 pt-1">{{$group->name}}</p>
        </div>
        @endforeach

    </div>
    <div class="row mb-1 pl-1">
        <div class="col-4">
        </div>
        @foreach($groups as $group)
        <div class="col">
            <p class="text-color-mount fontsize-mount2 pt-1 text-center">
                (
                @foreach($group->notes as $note)
                    {{$note->name}},
                    @endforeach
                )
            </p>
        </div>
        @endforeach


    </div>


{{--                                                                          selling value--}}
    <div class="row  pl-1">
        <div class="col-4">
            <label class="pl-3 text-color-mount fontsize-mount pr-4 my-auto">Selling Value</label>
        </div>

        @foreach($groups as $group)

        <div class="col col-item ">
            <p class="text-color-mount fontsize-mount17 pt-1">100</p>
        </div>
            @endforeach

    </div>
{{--                                            selling value 2nd role--}}
    <div class="row mb-1 pl-1">
        <div class="col-4">

        </div>
        @foreach($groups as $group)
            <div class="col">
                <p class="text-color-mount fontsize-mount2 pt-1 text-center">
                    (
                    @foreach($group->notes as $note)
                        {{$note->name}},
                    @endforeach
                )
                </p>
            </div>
            @endforeach


{{--        <div class="col">--}}
{{--            <p class="text-color-mount fontsize-mount2 pt-1 text-center">(200)</p>--}}
{{--        </div>--}}
{{--        <div class="col">--}}
{{--            <p class="text-color-mount fontsize-mount2 pt-1 text-center">(500)</p>--}}
{{--        </div>--}}
    </div>
{{--                                                            buying value--}}
    <div class="row mb-1 pl-1">
        <div class="col-4">
            <label class="pl-3 text-color-mount fontsize-mount pr-4 mt-3">Buying Value</label>
        </div>
        <div class="col mb-4">
            <div class="row">
                <div class="col col-item2">
                    <p class="text-color-mount fontsize-mount17 pt-1">10000</p>
                </div>
                <div class="col">
                    <div class="col-item-mini text-color-mount fontsize-mount2">
                        <input type="text" placeholder="Class A" class="pl-3" style="width: 100%;border: none;background-color: transparent">
                    </div>
                    <div class="col-item-mini text-color-mount fontsize-mount2 ">
                        <input type="text" placeholder="Class B" class="pl-3" style="width: 100%;border: none;background-color: transparent">
                    </div>
                    <div class="col-item-mini text-color-mount fontsize-mount2">
                        <input type="text" placeholder="Class C" class="pl-3" style="width: 100%;border: none;background-color: transparent">
                    </div>

                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="row">
                <div class="col col-item2">
                    <p class="text-color-mount fontsize-mount17 pt-1">2000</p>
                </div>
                <div class="col">
                    <div class="col-item-mini text-color-mount fontsize-mount2">
                        <input type="text" placeholder="Class A" class="pl-3" style="width: 100%;border: none;background-color: transparent">
                    </div>
                    <div class="col-item-mini text-color-mount fontsize-mount2 ">
                        <input type="text" placeholder="Class B" class="pl-3" style="width: 100%;border: none;background-color: transparent">
                    </div>
                    <div class="col-item-mini text-color-mount fontsize-mount2">
                        <input type="text" placeholder="Class C" class="pl-3" style="width: 100%;border: none;background-color: transparent">
                    </div>

                </div>


            </div>
        </div>
        <div class="col mb-4">
            <div class="row">
                <div class="col col-item2">
                    <p class="text-color-mount fontsize-mount17 py-1">15kyats</p>
                </div>
                <div class="col">
                    <div class="col-item-mini text-color-mount fontsize-mount2">
                        <input type="text" placeholder="Class A" class="pl-3" style="width: 100%;border: none;background-color: transparent">
                    </div>
                    <div class="col-item-mini text-color-mount fontsize-mount2 ">
                        <input type="text" placeholder="Class B" class="pl-3" style="width: 100%;border: none;background-color: transparent">
                    </div>
                    <div class="col-item-mini text-color-mount fontsize-mount2">
                        <input type="text" placeholder="Class C" class="pl-3" style="width: 100%;border: none;background-color: transparent">
                    </div>

                </div>
            </div>
        </div>
    </div>

