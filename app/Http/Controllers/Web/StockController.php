<?php /** @noinspection ALL */

namespace App\Http\Controllers\Web;
use App\Http\Requests\StockInventoryCreateValidation;
use App\Model\Branch;
use App\Model\BuyGroupValue;
use App\Model\Group;
use App\Model\GroupNote;
use App\Model\Note;
use App\Model\Transfer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function index()
    {
        $branches=Branch::all();
        $branch_id=Auth::user()->branch_id;
        $date=Carbon::today();
        $transfer_total_value=0;
        $total=array();
        if(Auth::user()->role_id==1)
        {
            foreach($branches as $branch){
                $transfers=Transfer::with('currency','group_note')
//                ->whereDate('date_time',$date)
                    ->orderBy('id','desc')
//                    ->where(function($query) use($branch){
//                        $query->where('from_branch_id',$branch->id)
//                            ->orWhere('to_branch_id',$branch->id);
//                    })
                    ->paginate(10);
//                    foreach($total_transfers as $transfers)
//                    {
////                        if($transfers->isNotEmpty())
////                        {
                            foreach($transfers as $transfer)
                            {
//                                dd($transfer);
                                if($transfer->to_branch_id == $branch->id && $transfer->from_branch_id ==$branch->id ||
                                    $transfer->to_branch_id == $transfer->from_branch_id)
                                {
                                    $transfer->transfer_status="Add";
                                }
                                elseif($transfer->to_branch_id== $branch->id  && $transfer->from_branch_id != $branch->id)
                                {
                                    $transfer->transfer_status="In";
                                }
                                elseif($transfer->from_branch_id== $branch->id && $transfer->to_branch_id != $branch->id)
                                    $transfer->transfer_status="Out";

                                $transfer->total_transfer_value= $this->total_transfer_value($transfer->id);
                                $transfer_total_value+=$this->total_transfer_value($transfer->id);
                            }
                            array_push($total,$transfer_total_value);


                $total_value=array_sum($total);

                return view('Stock.stock_inventory',compact('branches','transfers','total_value'));
            }

        }
        else if (Auth::user()->role_id==2)
        {
            $total_value=0;
            $branch_id=Auth::user()->branch_id;
            $transfers=$this->branch_transfers($branch_id);
//            if($totaltransfers->isNotEmpty()){
                foreach($transfers as $transfer)
                {
                    if($transfer->to_branch_id == $branch_id && $transfer->from_branch_id ==$branch_id)
                    {
                        $transfer->transfer_status="Add";
                    }
                    elseif($transfer->to_branch_id== $branch_id  && $transfer->from_branch_id != $branch_id)
                    {
                        $transfer->transfer_status="In";
                    }
                    elseif($transfer->from_branch_id== $branch_id && $transfer->to_branch_id != $branch_id)
                        $transfer->transfer_status="Out";

                    $transfer->total_transfer_value= $this->total_transfer_value($transfer->id);
                    $total_value+=$this->total_transfer_value($transfer->id);
                }
                return view('Stock.stock_inventory',compact('branches','transfers','total_value'));
//            }
//            return view('Stock.stock_inventory',compact('branches','total_transfers','total_value'));

//            return 'No Branch_Transfer';
        }
        else if(Auth::user()->role_id==3){
            $total_value=0;
            $branch_id=Auth::user()->branch_id;
            $transfers=$this->branch_transfers($date);
//            if($totaltransfers->isNotEmpty()){
            foreach($transfers as $transfer)
            {
                if($transfer->to_branch_id == $branch_id && $transfer->from_branch_id ==$branch_id)
                {
                    $transfer->transfer_status="Add";
                }
                elseif($transfer->to_branch_id== $branch_id  && $transfer->from_branch_id != $branch_id)
                {
                    $transfer->transfer_status="In";
                }
                elseif($transfer->from_branch_id== $branch_id && $transfer->to_branch_id != $branch_id)
                    $transfer->transfer_status="Out";

                $transfer->total_transfer_value= $this->total_transfer_value($transfer->id);
                $total_value+=$this->total_transfer_value($transfer->id);
            }
            return view('Stock.stock_inventory',compact('branches','transfers','total_value'));
        }
    }

    public function create()
    {

        $branch_total_value=$this->branch_total_value(Auth::user()->branch_id);
        return view('Stock.add',compact('branch_total_value'));
    }
    public function transfer()
    {
    }
    public function currency_filter($id)
    {
        $groups=Group::with('notes')->where('currency_id',$id)->get();
        $stock_notes=array();
        $total=0;
        $branch_id=Auth::user()->branch_id;

        foreach($groups as $group)
        {
            $note_id=DB::table('group_note')->where('group_id',$group->id)->orderBy('note_id','desc')->pluck('note_id');
            foreach ($note_id as $id)
            {
                $note=Note::whereId($id)->get();
                foreach ($note as $n)
                {
                    $group_note_id=DB::table('group_note')
//                        ->orderBy('id','asc')
                        ->where('note_id',$n->id)
                        ->where('group_id',$group->id)
                        ->pluck('id');
                    $g[]=$group_note_id[0];
                    $buying_value=BuyGroupValue::where('group_id',$group->id)
                        ->orderBy('date_time','DESC')
                        ->first();
//                    dd($buying_value);
                    if($buying_value!=null)
                    {
                        $total_sheet=DB::table('branch_group_note')->where('group_note_id',$group_note_id[0])
                            ->where('branch_id',$branch_id)
                            ->sum('sheet');
                        $n->group_id=$group->id;
                        $n->total_sheet=$total_sheet;
                        $total+=intval($total_sheet)*$buying_value->value;
                        array_push($stock_notes,$n);
                    }
                    else
                    {
                        return 'Empty buying value for this currency';

                    }



                }
            }
//            dd($g);
        }
//        dd($total);
        asort($stock_notes);

        $data=view('Stock.stock_currency_filter',compact('stock_notes','total'));
        return $data;
    }
    public function stock_transfer()
    {
        return view('Stock.transfer');
    }

    public function store(StockInventoryCreateValidation $request)
    {
//        dd($request->all());
        $vData=$request->validated();
        $branch_id=Auth::user()->branch->id;
        $transfer=new Transfer();
        $transfer->from_branch_id=$branch_id;
        $transfer->currency_id=$request->currency;
        $request->branch != null ? $transfer->to_branch_id=$request->branch : $transfer->to_branch_id=$branch_id;
        $transfer->date_time=now();
        $transfer->save();
        if($request->group==null)
        {
            return redirect('stock')->with('error','Please add currency group !');
        }
        $groups=array_unique($request->group);

        $note_id=$request->note_id;
        $notes=$request->notes;
        $note_array=array_combine($note_id,$notes);
//        if($request->branch)
//        {
//            $to_branch=Branch::find($request->branch);
//        }
             $branch=Branch::find($branch_id);

        foreach($groups as $group)
        {
            foreach($note_array as $id=>$value)
            {
                if($value==null)
                {
                    $value=0;
                }
                $group_note=GroupNote::where('note_id',$id)
                    ->where('group_id',$group)
                    ->pluck('id');
                if(isset($group_note[0]))
                {
                    $transfer->group_note()->attach($group_note[0],['sheet'=>$value]);
                    $branch_note=DB::table('branch_group_note')->where('group_note_id',$group_note[0])
                        ->where('branch_id',$branch_id)
                        ->pluck('sheet');
                    if( $request->branch==null)
                    {


                        if($branch_note->isEmpty())
                        {
                            $branch_note[0]=0;
                            $result=$branch_note[0]+intval($value);
                        }
                        else
                        {
                            $result=$branch_note[0]+intval($value);
                        }

                            $branch->branch_group_note()->wherePivot('group_note_id',$group_note[0])->detach();
                        $branch->branch_group_note()->attach($group_note[0],['sheet'=>$result]);

                    }
                    elseif( isset($branch_note[0]) && $request->branch != null)
                    {

                        if($branch_note[0]<intval($value))
                        {
                            return redirect('stock')->with('error','Not Enough!Your remaining balance is low.');
                        }
                        else
                        {
                            $result=$branch_note[0]-intval($value);
                            $branch->branch_group_note()->wherePivot('group_note_id',$group_note[0])->detach();
                        }

                        if($request->branch)
                        {
                            $to_branch=$this->to_branch_store($request->branch,$group_note[0],$value);

                        }

                        $branch->branch_group_note()->wherePivot('group_note_id',$group_note[0])->detach();
                        $branch->branch_group_note()->attach($group_note[0],['sheet'=>$result]);

                    }
                }

            }

        }
        return  redirect('stock');
    }
    public function stock_detail($transfer_id)
    {
        $transfers=Transfer::whereId($transfer_id)->first();
        $total_transfer_value=$this->total_transfer_value($transfer_id);
        foreach($transfers as $transfer)
        {
            $group_note_transfer=DB::table('group_note_transfer')->where('transfer_id',$transfer_id)->get();
//            dd($group_note_transfer);
            foreach($group_note_transfer as $gnt)
            {
                $group_note=DB::table('group_note')->whereId($gnt->group_note_id)->first();
                $sheet[]=$gnt->sheet;
                $notes=Note::whereId($group_note->note_id)->first();
                $note[]=$notes->name;
            }
            $transfer_note=array_filter(array_combine($note,$sheet));
        }
        $data=view('Stock.detail_view',compact('transfers','transfer_note','total_transfer_value'));
        return $data;
    }
    public function total_transfer_value($transfer_id)
    {
        $total_value=0;
        $group_note_transfer=DB::table('group_note_transfer')->where('transfer_id',$transfer_id)->get();
        foreach($group_note_transfer as $gnt)
        {
            $group_note=GroupNote::whereId($gnt->group_note_id)->first();
            $value=BuyGroupValue::where('group_id',$group_note->group_id)
                ->orderBy('date_time','DESC')
                ->first();
            if($value != null)
            {
                $total_value+=$value->value*$gnt->sheet;
            }
        }
        return $total_value;
    }
    public function to_branch_store($to_branch_id,$group_note_id,$value)
    {
        $to_branch=Branch::find($to_branch_id);
        $to_branch_note=DB::table('branch_group_note')->where('group_note_id',$group_note_id)
            ->where('branch_id',$to_branch_id)
            ->pluck('sheet');

        if($to_branch_note->isNotEmpty())
        {
            $to_result=$to_branch_note[0]+intval($value);
            $to_branch->branch_group_note()->wherePivot('group_note_id',$group_note_id)->detach();
            $to_branch->branch_group_note()->attach($group_note_id,['sheet'=>$to_result]);

        }
        elseif($to_branch_note->isEmpty()   )
        {
            $to_branch_note[0]=0;
            $to_result=$to_branch_note[0]+intval($value);
            $to_branch->branch_group_note()->attach($group_note_id,['sheet'=> $to_result]);
        }
    }
    public function branch_total_value($branch_id)
    {
        $values=0;
        $branch_group_note=DB::table('branch_group_note')->where('branch_id',$branch_id)->get();
        if($branch_group_note->isNotEmpty())
        {
            foreach($branch_group_note as $bgn)
            {
//            dd($bgn->sheet);
                $group_note=DB::table('group_note')->whereId($bgn->group_note_id)->first();
//            dd($group_note->group_id);
                $buying_value=DB::table('buy_group_values')->where('group_id',$group_note->group_id)->first();
//            dd($buying_value->value);
                $values+=$buying_value->value*$bgn->sheet;
//            dd($values);

            }
        }
        return $values;

    }
    public function total_transfers($date)
    {
//        $branch_id=Auth::user()->branch_id;
        $branches=Branch::all();
        foreach($branches as $branch)
        {
            $transfers[]=Transfer::with('currency','group_note')
//                ->whereDate('date_time',$date)
                ->orderBy('id','desc')
                ->where(function($query) use($branch){
                    $query->where('from_branch_id',$branch->id)
                        ->orWhere('to_branch_id',$branch->id);
                })
                ->paginate();
        }
        return $transfers;
    }
    public function branch_transfers($branch_id)
    {
            $transfers=Transfer::with('currency','group_note')
//                ->whereDate('date_time',$date)
                ->orderBy('id','desc')
                ->where(function($query) use($branch_id){
                    $query->where('from_branch_id',$branch_id)
                        ->orWhere('to_branch_id',$branch_id);
                })
                ->paginate(10);
//            dd($transfers);
        return $transfers;
    }
    public function transfer_datepicker(Request $request)
    {
//        return response()->json($request->all());
        $branch_id=Auth::user()->branch_id;
        $date=$request->date;
//        $transfers=Transfer::with('currency','group_note')
//            ->where('from_branch_id',$branch_id)
//            ->where('to_branch_id',$branch_id)
//            ->whereDate('date_time',$request->date)
//            ->orderBy('id','desc')
//            ->paginate(10);
        $transfers=$this->transfers($date);
//        dd($transfers);
        $transfer_total_value=0;
        if($transfers->isNotEmpty())
        {
            foreach($transfers as $transfer)
            {

                if($transfer->to_branch_id == $branch_id && $transfer->from_branch_id ==$branch_id)
                {
                    $transfer->transfer_status="Add";
                }
                elseif($transfer->to_branch_id== $branch_id  && $transfer->from_branch_id != $branch_id)
                {
                    $transfer->transfer_status="In";
                }
                elseif($transfer->from_branch_id== $branch_id && $transfer->to_branch_id != $branch_id)
                    $transfer->transfer_status="Out";

                $transfer->total_transfer_value= $this->total_transfer_value($transfer->id);
                $transfer_total_value+=$this->total_transfer_value($transfer->id);


            }
            $date=view('Stock.stock_history_filter',compact('transfers','transfer_total_value'));
            return $date;
        }
        return '<p style="padding-left: 400px;padding-top:40px;"><b>No Transfer </b></p>';


    }
    public function stock_branch_filter($branch)
    {
        $transfer_total_value=0;
        $transfers=$this->branch_transfers($branch);
        foreach($transfers as $transfer)
        {
//                                dd($transfer);
            if($transfer->to_branch_id == $branch && $transfer->from_branch_id ==$branch ||
                $transfer->to_branch_id == $transfer->from_branch_id)
            {
                $transfer->transfer_status="Add";
            }
            elseif($transfer->to_branch_id== $branch  && $transfer->from_branch_id != $branch)
            {
                $transfer->transfer_status="In";
            }
            elseif($transfer->from_branch_id== $branch && $transfer->to_branch_id != $branch)
                $transfer->transfer_status="Out";

            $transfer->total_transfer_value= $this->total_transfer_value($transfer->id);
            $transfer_total_value+=$this->total_transfer_value($transfer->id);
//            array_push($total,$transfer_total_value);


//            $total_value=array_sum($total);
        }
        $data=view('Stock.branch_filter_view',compact('transfers','total_value'));
        return $data;
//        dd($transfers);
    }
    public function transfer_status_filter($value)
    {
//        return response()->json($value);
        $branch_id=Auth::user()->branch_id;

//        $transfers=Transfer::all();
        $transfer_total_value=0;
        if($value==1)
        {
            $transfers=Transfer::with('currency','group_note')
                ->orderBy('id','desc')
                ->whereDate('date_time',Carbon::today())
                ->where(function($query) use($branch_id){
                    $query->where('from_branch_id','!=',$branch_id)
                        ->where('to_branch_id',$branch_id);
                })
                ->paginate(10);
            foreach($transfers as $transfer)
            {
                $transfer->transfer_status='In';
                $transfer->total_transfer_value= $this->total_transfer_value($transfer->id);
                $transfer_total_value+=$this->total_transfer_value($transfer->id);
            }

            $data=view('    Stock.transfer_status_filter',compact('transfers'));
            return $data;
        }
        elseif($value==2)
        {
            $transfers=Transfer::with('currency','group_note')
            ->orderBy('id','desc')
                ->whereDate('date_time',Carbon::today())
                ->where(function($query) use($branch_id){
                $query->where('from_branch_id',$branch_id)
                    ->where('to_branch_id','!=',$branch_id);
            })->paginate(10);
            foreach($transfers as $transfer)
            {
                $transfer->transfer_status='Out';
                $transfer->total_transfer_value= $this->total_transfer_value($transfer->id);
                $transfer_total_value+=$this->total_transfer_value($transfer->id);
            }

            $data=view('    Stock.transfer_status_filter',compact('transfers'));
            return $data;
        }
        elseif($value==3)
        {
            $transfers=Transfer::with('currency','group_note')
                ->orderBy('id','desc')
                ->whereDate('date_time',Carbon::today())
                ->where(function($query) use($branch_id){
                    $query->where('from_branch_id',$branch_id)
                        ->where('to_branch_id',$branch_id);
                })->paginate(10);
            foreach($transfers as $transfer)
            {
                $transfer->transfer_status='Add';
                $transfer->total_transfer_value= $this->total_transfer_value($transfer->id);
                $transfer_total_value+=$this->total_transfer_value($transfer->id);
            }

            $data=view('Stock.transfer_status_filter',compact('transfers'));
            return $data;
        }
        elseif($value==4)
        {
//            return $this->index();
            $transfers=$this->transfers(Carbon::today());
            foreach($transfers as $transfer)
            {

                if($transfer->to_branch_id == $branch_id && $transfer->from_branch_id ==$branch_id)
                {
                    $transfer->transfer_status="Add";
                }
                elseif($transfer->to_branch_id== $branch_id  && $transfer->from_branch_id != $branch_id)
                {
                    $transfer->transfer_status="In";
                }
                elseif($transfer->from_branch_id== $branch_id && $transfer->to_branch_id != $branch_id)
                    $transfer->transfer_status="Out";

                $transfer->total_transfer_value= $this->total_transfer_value($transfer->id);
                $transfer_total_value+=$this->total_transfer_value($transfer->id);


            }
            $data=view('Stock.transfer_status_filter',compact('transfers'));
            return $data;

//            return redirect('stock');
        }



    }
    protected function total($transfers)
    {
        $transfer_total_value=array();
        foreach($transfers as $transfer){
            foreach($transfer as $t)
            {
//                dd($t);
//            if($transfer->to_branch_id == $branch_id && $transfer->from_branch_id ==$branch_id)
//            {
//                $transfer->transfer_status="Add";
//            }
//            elseif($transfer->to_branch_id == $branch_id  &&  $transfer->from_branch_id != $branch_id)
//            {
//                $transfer->transfer_status="In";
//            }
//            elseif($transfer->from_branch_id== $branch_id && $transfer->to_branch_id != $branch_id)
//                $transfer->transfer_status="Out";
                $t->total_transfer_value= $this->total_transfer_value($t->id);
                $transfer_total_value=$this->total_transfer_value($t->id);
            }
        }
        return $transfer;


    }
}
