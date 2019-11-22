{{--@foreach($transfers as $t)--}}
    <div class="my-2">
        <p class="d-inline fontsize-mount text-nb-mount">Branch</p>
        <p id="branch" class="mount-input2 p-0 fontsize-mount text-nb-mount">: Branch1</p>
    </div>
    <div class="my-3">
        <p class="d-inline fontsize-mount text-nb-mount">Date : Time</p>
        <p id="branch" class="mount-input2 p-0 fontsize-mount text-nb-mount">: {{$transfers->date_time}}</p>
    </div>
    <div class="my-3">
        <p class="d-inline fontsize-mount text-nb-mount">Currency</p>
        <p id="branch" class="mount-input2 p-0 fontsize-mount text-nb-mount">: {{$transfers->currency->name}}</p>
    </div>
{{--@endforeach--}}

@foreach($transfer_note as $key=>$tn)
    <div class="my-3">
        <p class="d-inline fontsize-mount text-nb-mount">{{$key}}</p>
        <p id="branch" class="mount-input2 p-0 fontsize-mount text-nb-mount">: {{$tn}}</p>
    </div>
    @endforeach

    <hr>
    <div class="my-3">
        <p class="d-inline fontsize-mount6 font-weight-bold text-nb-mount">Total </p>
        <p id="branch" class="mount-input2 p-0 fontsize-mount6 text-nb-mount">: {{$total_transfer_value}} MMKs  </p>
    </div>


