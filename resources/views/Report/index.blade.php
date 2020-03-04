@extends('Layouts.master')
@section('content')
    <div class="container-nb-mount">
        <div class="d-flex justify-content-between top-box-mount shadow-sm">
            <div  class="my-auto btn-m ml-4 pl-3 dropdown">
                <select class="selectpicker" name="Branches" data-style="btn-white" data-width="auto" id="member_filter">
                    @php
                        $currencies=\App\Model\Currency::all();
                    @endphp
                    <option selected disabled>Choose...</option>
                    @foreach($currencies as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                </select>
                <select class="selectpicker" name="Branches" data-style="btn-white" data-width="auto" id="member_filter">
                    @php
                        $months=['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sept','Oct','Nov','Dec'];
                    @endphp
                    <option selected disabled>Month</option>
                    @foreach($months as $key=>$m)
                        <option value="{{$key+1}}">{{$m}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-md-offset-1">
                <div class="panel panel-default">
{{--                    <div class="panel-heading"><b>Charts</b></div>--}}
                    <div class="panel-body">
                        <canvas id="canvas" height="280" width="600"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
@section('script')
    <script>

        $(function(){
            var ctx = document.getElementById("canvas").getContext('2d');
            var currency=@json($currency);
            var days=@json($days);
            var amounts=['1000','2000','4000','5000'];
            console.log(amounts);
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels:days,
                    datasets: [{
                        label: 'Infosys Price',
                        // data: Prices,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true,
                                min:0,
                                max:100000000,
                                userCallback: function(value, index, values) {
                                    // Convert the number to a string and splite the string every 3 charaters from the end
                                    value = value.toString();
                                    value = value.split(/(?=(?:...)*$)/);

                                    // Convert the array to a string and format the output
                                    value = value.join(',');
                                    return  value + 'MMK';
                                }
                            }
                        }]
                    }
                }
            });
        });
    </script>
    @endsection

