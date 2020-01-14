<?php /** @noinspection ALL */

namespace App\Http\Controllers\Web;
use App\Http\Requests\StockInventoryCreateValidation;
use App\Http\Traits\CurrencyFilter;
use App\Model\Branch;
use App\Model\BuyClassGroupValue;
use App\Model\BuyGroupValue;
use App\Model\Classification;
use App\Model\ClassificationGroup;
use App\Model\Currency;
use App\Model\Group;
use App\Model\GroupNote;
use App\Model\Note;
use App\Model\Role;
use App\Model\Transfer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class StockController extends Controller
{
    use CurrencyFilter;
    public function index()
    {
//        dd('a');
        $branches = Branch::all();
        $branch_id = Auth::user()->branch_id;
        $date = Carbon::today();
        $transfer_total_value = 0;
        $total = array();
        $admin_role=Role::where('name','Admin')->first();
        $manager_role=Role::where('name','Manager')->first();
//        dd($manager_role->id);
        $front_man_role=Role::where('name','Front Man')->first();
        if (Auth::user()->role_id === $admin_role->id)
        {
            foreach ($branches as $branch) {
                $transfers = Transfer::with('currency', 'group_note')
//                ->whereDate('date_time',$date)
                    ->orderBy('id', 'desc')
//                    ->where(function($query) use($branch){
//                        $query->where('from_branch_id',$branch->id)
//                            ->orWhere('to_branch_id',$branch->id);
//                    })
                    ->paginate(10);
//                    foreach($total_transfers as $transfers)
//                    {
////                        if($transfers->isNotEmpty())
////                        {
                foreach ($transfers as $transfer) {
//                                dd($transfer);
                    if ($transfer->to_branch_id == $branch->id && $transfer->from_branch_id == $branch->id ||
                        $transfer->to_branch_id == $transfer->from_branch_id) {
                        $transfer->transfer_status = "Add";
                    } elseif ($transfer->to_branch_id == $branch->id && $transfer->from_branch_id != $branch->id) {
                        $transfer->transfer_status = "In";
                    } elseif ($transfer->from_branch_id == $branch->id && $transfer->to_branch_id != $branch->id)
                        $transfer->transfer_status = "Out";

                    $transfer->total_transfer_value = $this->total_transfer_value($transfer->id);
                    $transfer_total_value += $this->total_transfer_value($transfer->id);
                }
                array_push($total, $transfer_total_value);


                $total_value = array_sum($total);

                return view('Stock.stock_inventory', compact('branches', 'transfers', 'total_value'));
            }
        }
        elseif (Auth::user()->role_id=== $manager_role->id)
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
        elseif (Auth::user()->role_id=== $front_man_role->id){
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
    public function currency_branch_filter($currency_id,$branch_id){
//        dd($branch_id);
        return $this->currency_filter($currency_id,$branch_id);

    }
    public function currency_filter($id)
    {
        $currency_id=$id;
        $groups=Group::with('notes')->where('currency_id',$currency_id)->get();
        $currency=Currency::find($currency_id);
        $stock_notes=array();
        $total=0;
        $branch_id=Auth::user()->branch_id;
//        $total_sheet_per_class=0;
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
                    if($currency->name==="Myanmar Kyat")
                    {
                        $total_sheet=DB::table('branch_group_note')->where('group_note_id',$group_note_id[0])
                            ->where('branch_id',$branch_id)
                            ->sum('sheet');
                        $n->group_id=$group->id;
                        $n->total_sheet=$total_sheet;
                        $total+=intval($total_sheet);
                        array_push($stock_notes,$n);
                    }
//                    elseif($currency->name==="United States dollar"){
//                        dd('a');
//                    }
                    else{
//                        dd($group->id);
                        $us_currency_id=Currency::where('name','United States dollar')->first();
                        if($us_currency_id->id == $currency_id) {
                            $classification_group = \Illuminate\Support\Facades\DB::table('classification_group')->where('group_id', $group->id)
                                ->where('classification_id', 1)->first();
                            $buying_value = BuyClassGroupValue::where('classification_group_id', $classification_group->id)
                                ->orderBy('date_time', 'DESC')
                                ->first();
                            $total_sheet_per_class=0;
                            foreach(Classification::all() as $c){
                                $class_sheet=DB::table('branch_group_note_class')->where('group_note_id',$group_note_id[0])
                                    ->where('branch_id',$branch_id)
                                    ->where('class_id',$c->id)
                                    ->first();
                                if($class_sheet!=null){
                                    $total_sheet_per_class+=$class_sheet->sheet;
                                }else{
                                    $total_sheet_per_class=0;
                                }
                            }
                            $n->total_sheet=$total_sheet_per_class;
                        }else{
                            $buying_value=BuyGroupValue::where('group_id',$group->id)
                                ->orderBy('date_time','DESC')
                                ->first();
                            $total_sheet=DB::table('branch_group_note')->where('group_note_id',$group_note_id[0])
                                ->where('branch_id',$branch_id)
                                ->sum('sheet');
                            $n->total_sheet=$total_sheet;
                        }

//                    dd($buying_value);
//                        if($buying_value!=null )
//                        {

                            $n->group_id=$group->id;
                            $n->daily_value=$buying_value->value;
//                            $total+=intval($total_sheet)*$buying_value->value;
                            array_push($stock_notes,$n);
//                        }
//                        else
//                        {
//                            return 'Empty buying value for this currency';
//
//                        }

                    }

                }
            }
        }
        asort($stock_notes);
        $c=collect($stock_notes);
        $stock_notes=$c->groupBy('group_id');
//        dd($stock_notes);
            $data=view('Stock.stock_currency_filter',compact('stock_notes','total','currency_id'));
        return $data;
    }
    public function stock_transfer()
    {
        return view('Stock.transfer');
    }
    public function check_input(Request $request)
    {
//        return response()->json()
        $vData=Validator::make($request->all(),[
            "value"=> ['nullable',
            'numeric',
            'integer',
            'regex:/^\d+$/']
        ]);
        if($vData->fails())
        {
            return response()->json([
                'errors'=>$vData->errors(),
            ]);
        }
    }

    public function store(StockInventoryCreateValidation $request)
    {
//        dd($request->all());

        if($request->branch == null && Auth::user()->branch_id != null)
        {
//            dd('add');
            $branch_id=Auth::user()->branch_id;
        }
        elseif($request->branch != null && Auth::user()->branch_id !=null)
        {
//            dd('transfer');
            $branch_id=Auth::user()->branch_id;
        }
        elseif($request->branch !=null && Auth::user()->branch_id == null){
//            dd('admin add');
            $branch_id=$request->branch;
        }
        elseif($request->from_branch != null && Auth::user()->branch_id == null){
//            dd('admin transfer');
            $from_branch_id=$request->from_branch;
            $branch_id=$request->branch_id;
        }
//        dd($branch_id);
//        $branch=Branch::find($branch_id);
        if($request->from_branch !=null)
        {
            $from_branch=Branch::find($request->from_branch);
        }
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

             $branch=Branch::find($branch_id);
             $us_currency=Currency::where('name','United States dollar')->first();
             $classification=Classification::all();
//             dd($branch);
        foreach($groups as $group)
        {

            if($us_currency->id == (int) $request->currency)
            {
                $note_name=array_unique($request->note_name);
                $notes_id=array_unique($request->note_id);
                $classification_id=array_unique($request->classification_id);
                $class_group_value=array_combine($classification_id,$request->input('group_classification_value'.'_'.$group));
                foreach($class_group_value as $cid=>$cgv){
                    if($cgv!=null){
                        $class_group=ClassificationGroup::where('group_id',$group)
                            ->where('classification_id',$cid)->first();
                        $transfer->transfer_classification_group()->attach($class_group->id,['value'=>$cgv]);
                    }
                }
//                dd($notes_id);
                foreach($note_name as $name){
                    $note_class_value=array_combine($classification_id,$request->input('note_classification_value'.'_'.$name));
//                    dd($note_class_value);
                    if($note_class_value!=null){
//                        dd($note_class_value);
                        $note=Note::where('name',$name)->first();
                        $group_note=GroupNote::where('group_id',$group)
                            ->where('note_id',$note->id)->first();
//                        $branch_note=
                        if($group_note!=null){
                            foreach($note_class_value as $key=>$ncv){
                                if($ncv!=null){
                                    $transfer->transfer_group_note_class()->attach($transfer->id,['group_note_id'=>$group_note->id,'class_id'=>$key,'sheet'=>$ncv]);

//   *******************************************Admin and Manager Level add sheet with classification to his branch**************************************
                                    if(  $branch!=null ) {
//                                        dd($key);
                                        $branch_note=DB::table('branch_group_note_class')->where('group_note_id',$group_note->id)
                                            ->where('branch_id',$branch_id)
                                            ->where('class_id',$key)
                                            ->first();
                                        if($branch_note==null){
                                            $total_sheet=(int)$ncv;
                                        }else{
                                            $total_sheet=$branch_note->sheet+(int)$ncv;
                                        }
                                        if($branch!=null){
                                            $branch->branch_group_note_class()->wherePivot('group_note_id',$group_note->id)
                                                ->wherePivot('class_id',$key)->detach();
                                        }
                                        $branch->branch_group_note_class()->attach($branch_id,['group_note_id'=>$group_note->id,'class_id'=>$key,'sheet'=>$total_sheet]);
                                    }


                                }
                            }
                        }
                    }
                }

            }else{
                $note_id=$request->note_id;
                $note_array=array_combine($note_id,$request->notes);
                foreach($note_array as $id=>$value)
                {

                    foreach($request->group_value as $gp_value)
                    {
                        if($gp_value!=null)
                        {
                            $transfer->transfer_group()->attach($group,['value'=>$gp_value]);

                        }
                    }
                    if($value==null)
                    {
                        $value=0;
                    }
                    $group_note=GroupNote::where('note_id',$id)
                        ->where('group_id',$group)
                        ->pluck('id');
                    if(isset($group_note[0]) && $group_note!=null)
                    {
                        $transfer->group_note()->attach($group_note[0],['sheet'=>$value]);
                        $branch_note=DB::table('branch_group_note')->where('group_note_id',$group_note[0])
                            ->where('branch_id',$branch_id)
                            ->pluck('sheet');
//                    dd($request->from_branch);
//                    dd($group_note[0]);
                        $from_branch_note=DB::table('branch_group_note')->where('group_note_id',$group_note[0])
                            ->where('branch_id',$request->from_branch)
                            ->pluck('sheet');
//            *******************Manager add sheet to his branch******************************************


                        if( $request->branch==null && Auth::user()->branch_id != null ) {
//                        dd('add');
                            if ($branch_note->isEmpty()) {
                                $branch_note[0] = 0;
                                $result = $branch_note[0] + intval($value);
                            } else {
                                $result = $branch_note[0] + intval($value);
                            }
                            if ($branch != null) {
                                $branch->branch_group_note()->wherePivot('group_note_id', $group_note[0])->detach();
                            }
                            $branch->branch_group_note()->attach($group_note[0], ['sheet' => $result]);


                        }


//          *****************************End Manager add sheet to his branch**********************************


//          **************************Manager transfers sheet from branch to branch***************************
                        elseif( isset($branch_note[0]) && $request->branch != null && Auth::user()->branch_id != null) {
//                        dd('transfer');
//                        dd($branch_note[0]);
//                        dd($value);
                            if ($branch_note[0] < intval($value)) {
                                return redirect('stock')->with('error', 'Not Enough!Your remaining balance is low.');
                            } else {
                                $result = $branch_note[0] - intval($value);
                                $branch->branch_group_note()->wherePivot('group_note_id', $group_note[0])->detach();
                                $branch->branch_group_note()->attach($group_note[0], ['sheet' => $result]);
                            }
                            if ($request->branch) {
                                $to_branch = $this->to_branch_store($request->branch, $group_note[0], $value);

                            }
                        }
//           **************************End Manager transfers sheet from branch to branch***************************

//           **************************Admin add sheet to branch *************************************************
                        elseif($request->branch !=null && Auth::user()->branch_id == null && $request->from_branch == null){
                            if($branch_note->isEmpty())
                            {
                                $branch_note[0]=0;
                                $result=$branch_note[0]+intval($value);
                            }
                            else {
                                $result=$branch_note[0]+intval($value);
                            }
                            if($branch!=null)
                            {

                                $branch->branch_group_note()->wherePivot('group_note_id',$group_note[0])->detach();
                            }
                            $branch->branch_group_note()->attach($group_note[0],['sheet'=>$result]);

                        }

//                 **************************End Admin add sheet to branch *************************************************


//                 ****************************Admin transfers sheet from branch to branch**********************************
                        elseif($request->from_branch != null && $request->branch != null && Auth::user()->branch_id==null){
                            if($from_branch_note[0]<intval($value))
                            {
                                return redirect('stock')->with('error','Not Enough!Your remaining balance is low.');
                            }
                            else
                            {
                                $result=$from_branch_note[0]-intval($value);
                                $from_branch->branch_group_note()->wherePivot('group_note_id',$group_note[0])
                                    ->wherePivot('branch_id',$from_branch->id)
                                    ->detach();
                                $from_branch->branch_group_note()->attach($group_note[0],['sheet'=>$result]);
                            }
                            if($request->branch)
                            {
                                $to_branch=$this->to_branch_store($request->branch,$group_note[0],$value);

                            }
                        }

//              ****************************Admin transfers sheet from branch to branch**********************************

                        else
                        {
                            dd('Something Wrong!');
                        }
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
//            dd($group_note);
            $note=Note::find($group_note->note_id);
            $group=Group::with('currency')->whereId($group_note->group_id)->first();
//            dd($group);
            if($group_note !=null && $group->currency->name !== "Myanmar Kyat")
            {
                $value=BuyGroupValue::where('group_id',$group_note->group_id)
                    ->orderBy('date_time','DESC')
                    ->first();
                if($value != null)
                {
                    $total_value+=$value->value*(intval($note->name)*$gnt->sheet);
                }
            }elseif($group->currency->name === "Myanmar Kyat"){
                $total_value+=(intval($note->name)*$gnt->sheet);
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
                $group_note=DB::table('group_note')->whereId($bgn->group_note_id)->first();
                $note=Note::find($group_note->note_id);
                $group=Group::with('currency')->whereId($group_note->group_id)->first();
                $buying_value=DB::table('buy_group_values')->where('group_id',$group_note->group_id)->first();
                if($buying_value!=null && $group->currency->name !== "Myanmar Kyat"){
                    $values+=$buying_value->value*(intval($note->name)*$bgn->sheet);
                }
                elseif($group->currency->name === "Myanmar Kyat"){
                    $values+=(intval($note->name)*$bgn->sheet);
                }
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
    public function get_branch()
    {
        $branch=Auth::user()->branch_id ? Auth::user()->branch_id : "admin_add";
        return $branch;
    }
    public function get_transfer_branch()
    {
        $branch=Auth::user()->branch_id ? Auth::user()->branch_id : "admin_transfer";
        return $branch;
    }
}
