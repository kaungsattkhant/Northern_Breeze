


    <div class="col">
        <table class="table border-0 bg-white box-shadow-mount border-tab-radius-mount" id="stock_table_filter">
            <tbody class="rounded-table-mount" >
            @foreach($stock_notes as $group_name=>$stock_note)
                <tr>
                    <td>
                        <h3 class="pb-2">
                            @php
                                $gp_name=\App\Model\Group::with('currency')->whereId($group_name)->first();
                                 if($gp_name->currency->name==="United States dollar"){
                                      $classification_group=DB::table('classification_group')->where('group_id',$gp_name->id)
                        ->where('classification_id',1)->first();
                                     $daily_value=\App\Model\BuyClassGroupValue::where('classification_group_id',$classification_group->id)
                        ->latest()->first();
                                 }else{
                                     $daily_value=\App\Model\BuyGroupValue::where('group_id',$group_name)->latest()->first();

                                 }


                            @endphp
                            {{$gp_name->name}}
                        </h3>
                    </td>
                    <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">
                        @if($daily_value !=null)
                            {{$daily_value->value}}

                        @endif
                    </td>
                </tr>
                @foreach($stock_note as $note)
                <tr>
                    <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">{{ $note->name}}</td>
{{--                                        <td>  {{$note->daily_value}}</td>--}}

                    <input type="hidden" name="note_id[]" value="{{$note->id}}">
                    <td class="text-right border-top-0 pt-4">
                        <p class="text-color-mount fontsize-mount2" style="padding-bottom: 1px">{{$note->total_sheet}}</p>
                    </td>
                </tr>
                    @endforeach
            @endforeach
            </tbody>
        </table>
        <div class="div-p-mount2">
            @if($total!=null)
                {{$total}}
                @endif
{{--            <p>Total : {{$total}} MMKs </p>--}}

        </div>
    </div>
    <div class="col">
        <table class="table border-0 bg-white box-shadow-mount d-flex rounded-table-mount mt-0 pb-1">
            <tbody class="rounded-table-mount pb-5">

            @foreach($stock_notes as $group_name=>$stock_note)
                <tr>

                    <td>
                        <h3>
{{--                            Group-{{$group_name}}--}}
                            @php
                               $gp_name=\App\Model\Group::whereId($group_name)->first();
                            @endphp
                            {{$gp_name->name}}
                        </h3>
                    </td>
                    <td class="text-right border-top-0 pt-4 pb-4">
                        @php
                            $classifications=\App\Model\Classification::all();
                        @endphp
                        @php
                            $us_currency_id=\App\Model\Currency::where('name','United States dollar')->first();
                        @endphp
                        @if($currency_id == $us_currency_id->id)
                        @foreach($classifications as $classification)
                            <input type="text" name=group_classification_value_{{$group_name}}[] class="note_class border rounded-table-mount w-21 text-center fontsize-mount3 pt-1 "   id="input1" placeholder="{{$classification->name}}" onchange=" check($(this).val())">
                        @endforeach
                        @else
                        <input type="text" name=group_value[] class="note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1 "  placeholder="" >
                            @endif
                    </td>
                </tr>
                @foreach($stock_note as $note)

                    <tr>
                        <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">{{$note->name}} </td>
                        <td class="text-right border-top-0 pt-4 pb-4">
                            {{--                    <input type="text" name=notes[] class="note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1 "  onfocusout="return stockValidation({{$note->name}})" id="input1" placeholder="">--}}
{{--                            <input type="text" name=notes[] class="note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1 "   id="input1" placeholder="" onchange=" check($(this).val())">--}}
                            @php
                              $classifications=\App\Model\Classification::all();
                            @endphp
{{--                            @php--}}
{{--                                $us_currency_id=\App\Model\Currency::where('name','United States dollar')->first();--}}
{{--                            @endphp--}}
                            @if($currency_id == $us_currency_id->id)
                            @foreach($classifications as $classification)
                                    <input type="hidden" name="classification_id[]" value="{{$classification->id}}">
                                    <input type="hidden" name="note_name[]" value="{{$note->name}}">
                                    <input type="hidden" name="class_group_id[]" value="{{$note->group_id}}">
                                <input type="text" name=note_classification_value_{{$note->name}}[] class="note_class border rounded-table-mount w-21 text-center fontsize-mount3 pt-1 "   id="input1" placeholder="{{$classification->name}}" onchange=" check($(this).val())">
                            @endforeach
                            @else
                                <input type="text" name=notes[] class="note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1 "   id="input1" placeholder="" onchange=" check($(this).val())">

                            @endif
                            <span class="note_error[]" id=""></span>
                            <input type="hidden" name="group[]" value="{{$note->group_id}}">
                            <br>
                            <span class="text-danger">
                                <strong class="check_input"></strong>
                            </span>
                        </td>
                    </tr>


                    {{--                @if($note->group_id==)--}}
                    @endforeach

            @endforeach

            </tbody>

        </table>
        <div class="div-p-mount2 text-center">

            <p>Total :</p>
        </div>


    </div>

