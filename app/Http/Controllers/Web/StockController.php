<?php /** @noinspection ALL */

namespace App\Http\Controllers\Web;
use App\Http\Requests\StockInventoryCreateValidation;
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


    public function index()
    {
        $branches = Branch::all();
        $branch_id = Auth::user()->branch_id;
        $date = Carbon::today();
        $transfer_total_value = 0;
        $total = array();
        $admin_role=Role::where('name','Admin')->first();
        $manager_role=Role::where('name','Manager')->first();
//        dd($manager_role->id);
        $front_man_role=Role::where('name','Front Man')->first();
        if (Auth::user()->isAdmin())
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
                    } elseif ($transfer->from_branch_id == $branch->id && $transfer->to_branch_id != $branch->id){
                        $transfer->transfer_status = "Out";
                    }
                    $transfer->total_transfer_value = $this->total_transfer_value($transfer->id,$transfer->transfer_status);
                    $transfer_total_value += $this->total_transfer_value($transfer->id,$transfer->transfer_status);
                }
                array_push($total, $transfer_total_value);
                $total_value = array_sum($total);

                return view('Stock.stock_inventory', compact('branches', 'transfers', 'total_value'));
            }
        }
        elseif (Auth::user()->isManager())
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

                    $transfer->total_transfer_value= $this->total_transfer_value($transfer->id,$transfer->transfer_status);
                    $total_value+=$this->total_transfer_value($transfer->id,$transfer->transfer_status);
                }
                return view('Stock.stock_inventory',compact('branches','transfers','total_value'));
//            }
//            return view('Stock.stock_inventory',compact('branches','total_transfers','total_value'));

//            return 'No Branch_Transfer';
        }
//        elseif (Auth::user()->role_id=== $front_man_role->id){
//            $total_value=0;
//            $branch_id=Auth::user()->branch_id;
//            $transfers=$this->branch_transfers($date);
////            if($totaltransfers->isNotEmpty()){
//            foreach($transfers as $transfer)
//            {
//                if($transfer->to_branch_id == $branch_id && $transfer->from_branch_id ==$branch_id)
//                {
//                    $transfer->transfer_status="Add";
//                }
//                elseif($transfer->to_branch_id== $branch_id  && $transfer->from_branch_id != $branch_id)
//                {
//                    $transfer->transfer_status="In";
//                }
//                elseif($transfer->from_branch_id== $branch_id && $transfer->to_branch_id != $branch_id)
//                    $transfer->transfer_status="Out";
//                $transfer->total_transfer_value= $this->total_transfer_value($transfer->id);
//                $total_value+=$this->total_transfer_value($transfer->id);
//            }
//            return view('Stock.stock_inventory',compact('branches','transfers','total_value'));
//        }
    }
    public function create()
    {

        $currencies = Currency::all();
        $branches = Branch::all();
        $auth_id = Auth::user()->branch_id;
        $is_admin=Auth::user()->isAdmin();
        $branch_total_value=$this->branch_total_value(Auth::user()->branch_id);
        return view('Stock.add',compact('branch_total_value','currencies','branches','auth_id','is_admin'));
    }
    public function transfer()
    {
    }
    public function currency_branch_filter($currency_id,$branch_id){
        return $this->currency_filter($currency_id,$branch_id);
    }

    public function currency_filter(Request $request){
        $currency_id=$request->currency_id;
        $b_id=$request->from_branch;

        $classification=Classification::orderBy('id','asc')->get('id','name');
        $us_currency_id=Currency::where('name','United States dollar')->first();
        $myanmar_currency=Currency::where('name','Myanmar Kyat')->first();
        $groups=Group::with('notes')->where('currency_id',$currency_id)->get();
        if($currency_id==$myanmar_currency->id){
            $status="MMK";
        }elseif($currency_id==$us_currency_id->id) {
            $status="us_currency";
            }else{
            $status="other";
        }
        $branch_id = Auth::user()->branch_id ? Auth::user()->branch_id : $b_id;
        if($groups->isNotEmpty()){
            foreach($groups as $key=>$group){
                $new[$key]=new \stdClass();
                $new[$key]->group_id=$group->id;
                $new[$key]->group_name=$group->name;

                $note_id=DB::table('group_note')->where('group_id',$group->id)->orderBy('note_id','desc')->pluck('note_id');
                foreach ($note_id as $i=>$id)
                {
//                    dd($id);
                    $note=Note::whereId($id)->first();
//                    dd($note);
                    $group_note_id=DB::table('group_note')
                        ->where('note_id',$id)
                        ->where('group_id',$group->id)
                        ->first();
                    $notes[$key][$i]=new \stdClass();
                    $notes[$key][$i]->group_note_id=$group_note_id->id;
                    $notes[$key][$i]->note_name=$note->name;
                    $total_sheet=0;

                    if($currency_id==$myanmar_currency->id){
//                        dd('aa');
                        $bgn=DB::table('branch_group_note')->where('branch_id',$branch_id)
                            ->where('group_note_id',$group_note_id->id)->first();
                        if($bgn==null){
                            $total_sheet=0;
                        }else{
                            $total_sheet+=(int)$bgn->sheet;
                        }
                        $class_sheet=null;
                    }else{
                        foreach($classification as $bc=>$class){
//                            $class_sheet[$bc]=new \stdClass();

                            $branch_class_sheet=DB::table('branch_group_note_class')
                                ->where('branch_id',$branch_id)
                                ->where('class_id',$class->id)
                                ->where('group_note_id',$group_note_id->id)->first();
                            $cg_id = \Illuminate\Support\Facades\DB::table('classification_group')->where('group_id', $group->id)
                                ->where('classification_id', $class->id)->first();
                            $aaaaa[] = $cg_id;
                            if($cg_id !=null ){
                                $class_sheet[$bc]=new \stdClass();
                                if($branch_class_sheet == null){
                                    $class_sheet[$bc]->class_id=$class->id;
                                    $class_sheet[$bc]->sheet=0;
                                }else{
                                    $class_sheet[$bc]->class_id=$branch_class_sheet->class_id;
                                    $class_sheet[$bc]->sheet=$branch_class_sheet->sheet;
                                    $total_sheet+=(int)$class_sheet[$bc]->sheet;
                                }
                            }

                        }


                    }
//                    dd($total_sheet);

                    $notes[$key][$i]->class_sheet=$class_sheet;
                    $notes[$key][$i]->total_sheet=$total_sheet;

                }
                if($currency_id== $myanmar_currency->id){
//                    $currency_value=new \stdClass();
//                    $currency_value->id="null";
//                    $currency_value->value="null";
                    $currency_value=null;
                } else{
                    foreach($classification as $c=>$class){
                        $classification_group_id = \Illuminate\Support\Facades\DB::table('classification_group')->where('group_id', $group->id)
                            ->where('classification_id', $class->id)->first();
                        if($classification_group_id!=null){
                            $buy_class_value= BuyClassGroupValue::where('classification_group_id', $classification_group_id->id)
                                ->latest()
                                ->first();
                            $currency_value[$c]=new \stdClass();
                            $currency_value[$c]->id=$buy_class_value->id;
                            $currency_value[$c]->class_id=$class->id;
                            $currency_value[$c]->value=$buy_class_value->value;
                        }
                    }
                }
                $new[$key]->class_currency_value=$currency_value;

            }
            foreach($new as $k=>$n){
                $new[$k]->notes=$notes[$k];
            }
            if($currency_id==$us_currency_id->id){
                return response()->json([
                    'class'=>$classification,
                    'status'=>$status,
                    'groups'=> $new,
                ]);
            }else{
                return response()->json([
                    'class'=>null,
                    'status'=>$status,
                    'groups'=> $new,
                ]);
            }
        }
        else{
            return response()->json([
                'is_success'=>false,
                'message'=>'First,make notes as a group',
            ]);
        }
    }
    public function add_stock(Request $request){
        $data=json_encode($request->all());
        $stock_data=json_decode($data);
        if($stock_data->branch == null && Auth::user()->branch_id != null)
        {
//            manager_add
            $branch_id=Auth::user()->branch_id;
        }elseif($stock_data->branch !=null && Auth::user()->branch_id == null){
//            dd('admin_add');
            $branch_id=$stock_data->branch;
        }
        $branch=Branch::find($branch_id);
//        dd($stock_data);
        $transfer=Transfer::create([
            'from_branch_id'=>$branch_id,
            'to_branch_id'=>$stock_data->branch != null ? $stock_data->branch :$branch_id,
            'currency_id'=>$stock_data->currency_id,
            'date_time'=>now(),
        ]);
        foreach($stock_data->groups as $stocks){
            if($stock_data->status==="MMK"){
                foreach($stocks->notes as $n){
                    if($n->total_sheet!=0){
                        $transfer->group_note()->attach($n->group_note_id,['sheet'=>$n->total_sheet]);

                    }
                    $bgn=DB::table('branch_group_note')->where('group_note_id',$n->group_note_id)
                        ->where('branch_id',$branch->id)
                        ->first();
//                    dd($n->total_sheet);
                    if($bgn==null ){

                        $total_sheet=(int)$n->total_sheet;
                    }else{

                        $total_sheet=(int)$n->total_sheet+(int)$bgn->sheet;
                    }

                    $branch->branch_group_note()->wherePivot('group_note_id',$n->group_note_id)
                        ->wherePivot('branch_id',$branch->id)->detach();
                    if($total_sheet!=0){
                        $branch->branch_group_note()->attach($n->group_note_id,['sheet'=>$total_sheet]);
                    }
                }

            }else{
                foreach($stocks->class_currency_value as $cgv){
                    if($cgv->value!=null){
                        $cg=ClassificationGroup::where('group_id',$stocks->group_id)
                            ->where(function ($query) use ($cgv){
                                $query->where('classification_id',$cgv->class_id);
                            })->first();
                        if($cgv->value!=0){
                            $transfer->transfer_classification_group()->attach($cg->id,['value'=>$cgv->value]);
                        }
                    }
                }
                foreach($stocks->notes as $note){
                    foreach($note->class_sheet as $cs){
                        if($cs!=null){
                            if($cs->sheet!=0){
                                $transfer->transfer_group_note_class()
                                    ->attach($transfer->id,['group_note_id'=>$note->group_note_id,'class_id'=>$cs->class_id,'sheet'=>$cs->sheet]);
                            }
                            $remain_branch_sheet=DB::table('branch_group_note_class')
                                ->where('group_note_id',$note->group_note_id)
                                ->where('branch_id',$branch->id)
                                ->where('class_id',$cs->class_id)
                                ->first();
//                            dd($remain_branch_sheet);
                            if($remain_branch_sheet==null ){
                                    $t_sheet=$cs->sheet;
                            }else{

                                    $t_sheet=(int)$remain_branch_sheet->sheet +(int)$cs->sheet;
                            }

                                $branch->branch_group_note_class()->wherePivot('group_note_id',$note->group_note_id)
                                    ->wherePivot('class_id',$cs->class_id)->detach();
                            if($t_sheet!=0){
                                $branch->branch_group_note_class()
                                    ->attach($branch->id,['group_note_id'=>$note->group_note_id,'class_id'=>$cs->class_id,'sheet'=>$t_sheet]);
                            }

                        }
                    }
                }
            }

        }
        return response()->json([
            'is_success'=>true,
        ]);
    }
    public function stock_transfer()
    {
        $currencies = Currency::all();
        $branches = Branch::all();
        $is_admin=Auth::user()->isAdmin();
        $auth_id = Auth::user()->branch_id;
        return view('Stock.transfer',compact('currencies','branches','is_admin','auth_id'));
    }
    public function transfer_currency(Request $request){
        $data=json_encode($request->all());
        $transfer_data=json_decode($data);
//        dd($transfer_data);
        if($request->to_branch != null && $request->from_branch ==null) {
//            dd('manager_transfer');
            $branch_id=Auth::user()->branch_id;
        }elseif($request->from_branch != null && $request->to_branch != null ){
//            dd('admin_transfer');
            $branch_id=$request->from_branch;
        }
        $from_branch=Branch::find($branch_id);
        $to_branch=Branch::find($request->to_branch);
        $transfer=Transfer::create([
            'from_branch_id'=>$from_branch->id,
            'to_branch_id'=>$to_branch->id,
            'currency_id'=>$request->currency_id,
            'date_time'=>now(),
        ]);
        foreach($transfer_data->groups as $t){
            if($transfer_data->status==="MMK"){
                foreach($t->notes as $n){
                    if($n->total_sheet!=0){
                        $transfer->group_note()->attach($n->group_note_id,['sheet'=>$n->total_sheet]);
                      }
                    $bgn=DB::table('branch_group_note')->where('group_note_id',$n->group_note_id)
                        ->where('branch_id',$from_branch->id)
                        ->first();
                    if($bgn!=null && $bgn->sheet>=$n->total_sheet){
                        $from_total_sheet=(int)$bgn->sheet-(int)$n->total_sheet;
                        $from_branch->branch_group_note()->wherePivot('group_note_id',$n->group_note_id)
                            ->wherePivot('branch_id',$from_branch->id)->detach();
                        if($from_total_sheet!=0){
                            $from_branch->branch_group_note()->attach($n->group_note_id,['sheet'=>$from_total_sheet]);
                        }
                        $to_branch_store=$this->to_branch_store($to_branch->id,$n->group_note_id,$n->total_sheet);
                    }
                }
            }else{
                if($transfer_data->transfer_type==="branch_to_supplier"){
                    foreach($t->class_currency_value as $cgv){
                        if($cgv!=null){
                            $cg=ClassificationGroup::where('group_id',$t->group_id)
                                ->where(function ($query) use ($cgv){
                                    $query->where('classification_id',$cgv->class_id);
                                })->first();
                            if($cgv->value!=0){
                                $transfer->transfer_classification_group()->attach($cg->id,['value'=>$cgv->value]);
                            }
                        }
                    }
                }

                foreach($t->notes as $note){
                    foreach($note->class_sheet as $cs){

                        if($cs->sheet!=0){
                            $transfer->transfer_group_note_class()
                                ->attach($transfer->id,['group_note_id'=>$note->group_note_id,'class_id'=>$cs->class_id,'sheet'=>$cs->sheet]);
                        }
                        $transfer_other=$this->transfer_other($from_branch->id,$to_branch->id,$note->group_note_id,$cs->class_id,$cs->sheet);
//                        $remain_from_branch=DB::table('branch_group_note_class')
//                            ->where('group_note_id',$note->group_note_id)
//                            ->where('branch_id',$from_branch->id)
//                            ->where('class_id',$cs->class_id)
//                            ->first();
                    }
                }


            }
        }
        return response()->json([
            'is_success'=>true,
        ]);

    }
    public function transfer_other($from_branch_id,$to_branch_id,$group_note_id,$class_id,$t_sheet){
        $from_branch=Branch::find($from_branch_id);
        $to_branch=Branch::find($to_branch_id);
        $remain_from_branch=DB::table('branch_group_note_class')
            ->where('group_note_id',$group_note_id)
            ->where('branch_id',$from_branch_id)
            ->where('class_id',$class_id)
            ->first();
        if($remain_from_branch!=null && $remain_from_branch->sheet>=$t_sheet){
            $b_total_sheet=$remain_from_branch->sheet - $t_sheet;
            $from_branch->branch_group_note_class()->wherePivot('group_note_id',$group_note_id)
                ->wherePivot('class_id',$class_id)->detach();
            if($b_total_sheet!=0){
                $from_branch->branch_group_note_class()
                    ->attach($from_branch->id,['group_note_id'=>$group_note_id,'class_id'=>$class_id,'sheet'=>$b_total_sheet]);
            }
        }
        $add_to_branch=DB::table('branch_group_note_class')
            ->where('group_note_id',$group_note_id)
            ->where('branch_id',$to_branch_id)
            ->where('class_id',$class_id)
            ->first();
        if($add_to_branch!=null){
            $ts=$add_to_branch->sheet+$t_sheet;
            $to_branch->branch_group_note_class()->wherePivot('group_note_id',$group_note_id)
                ->wherePivot('class_id',$class_id)->detach();
            $to_branch->branch_group_note_class()
                ->attach($to_branch->id,['group_note_id'=>$group_note_id,'class_id'=>$class_id,'sheet'=>$ts]);
        }else{
            if($t_sheet!=0){
                $to_branch->branch_group_note_class()
                    ->attach($to_branch->id,['group_note_id'=>$group_note_id,'class_id'=>$class_id,'sheet'=>$t_sheet]);
            }

        }
    }
    public function stock_detail($transfer_id)
    {
//        dd($transfer_id);
        $transfers=Transfer::find($transfer_id);
//        $total_transfer_value=$this->total_transfer_value($transfer_id);

        foreach($transfers as $transfer)
        {
//            dd($transfers->currency->name==="Myanmanr Kyat");
            if($transfers->currency->name==="Myanmar Kyat"){
                $total_transfer_sheet=DB::table('group_note_transfer')->where('transfer_id',$transfer_id)->get();
                $total_transfer=$total_transfer_sheet->groupBy('group_note_id');

            }else{
//                $transfer_sheet=DB::table('transfer_group_note_class')->where('transfer_id',$transfer_id)->sum('sheet');
                $total_transfer_sheet=DB::table('transfer_group_note_class')
                    ->where('transfer_id',$transfer_id)
                    ->get();
                $total_transfer=$total_transfer_sheet->groupBy('group_note_id');
            }
                foreach($total_transfer as $key=>$gnt)
                {
                    $sheet=0;

                    $transfer_note[$key]=new \stdClass();
                    foreach($gnt as $i=>$t){
                        if($t->group_note_id==$key){
                            $group_note=DB::table('group_note')->whereId($t->group_note_id)->first();
                            $sheet+=$t->sheet;
                            $notes=Note::whereId($group_note->note_id)->first();
                        }

                    }
                    $transfer_note[$key]->note=$notes->name;
                    $transfer_note[$key]->total_sheet=$sheet;
                }
        }
        $data=view('Stock.detail_view',compact('transfers','transfer_note'));
        return $data;
    }

    public function total_transfer_value($transfer_id,$status)
    {
        $total_value=0;
        $t=Transfer::find($transfer_id);
        $branch=Branch::find($t->from_branch_id);
        $to_branch=Branch::find($t->to_branch_id);
        if($t->currency->name==="Myanmar Kyat"){
            $group_note_transfer=DB::table('group_note_transfer')->where('transfer_id',$transfer_id)->get();
            foreach($group_note_transfer as $gnt)
            {
                $group_note=GroupNote::whereId($gnt->group_note_id)->first();
                $note=Note::find($group_note->note_id);
                $gv=DB::table('transfer_group')
                    ->where('transfer_id',$gnt->transfer_id)
                    ->where('group_id',$group_note->group_id)->first();
//                dd($gv);
                if($gv !=null && $t->currency->name !== "Myanmar Kyat") {
                    $total_value+=$gv->value*(intval($note->name)*$gnt->sheet);
                }elseif($t->currency->name === "Myanmar Kyat"){
                    $total_value+=(intval($note->name)*$gnt->sheet);
                }
            }
//
        }else{
                $tgnc=DB::table('transfer_group_note_class')->where('transfer_id',$transfer_id)->get();
                foreach($tgnc as $tg){
                    $group_note=GroupNote::whereId($tg->group_note_id)->first();
                    $note=Note::find($group_note->note_id);
                    $cg=DB::table('classification_group')->where('group_id',$group_note->group_id)
                        ->where('classification_id',$tg->class_id)
                        ->first();
                    if($to_branch->branch_type_id == 2) {
                        $currency_value=DB::table('transfer_class_group')
                            ->where('transfer_id',$tg->transfer_id)
                            ->where('classification_group_id',$cg->id)
                            ->first();
//                        dd($currency_value);
                    }else{
//                        dd($status);
                        if($status==="Add"){
                            $currency_value=DB::table('transfer_class_group')
                                ->where('transfer_id',$tg->transfer_id)
                                ->where('classification_group_id',$cg->id)
                                ->first();
//                            dd($currency_value);
                        }
                        else{
                            $currency_value= BuyClassGroupValue::where('classification_group_id', $cg->id)
                                ->latest()
                                ->first();
                        }

                    }
//                    dd($currency_value);
                    if($currency_value!=null){
                        $total_value+=$currency_value->value*(intval($note->name)*$tg->sheet);
                    }
                }
        }
        return $total_value;
    }
    public function transfer_filter(Request $request){
//        return response()->json($request->all());
        $date=$request->date!=null ? $request   ->date : today();
        $branch_id=$request->branch;
        $status=$request->status;
        $transfer_total_value=0;
        if($status==="in"){
//            dd("in");
            $transfers=Transfer::with('currency','group_note')
                ->orderBy('id','desc')
                ->whereDate('date_time',$date)
                ->where(function($query) use($branch_id){
                    $query->where('from_branch_id','!=',$branch_id)
                        ->where('to_branch_id',$branch_id);
                })
                ->paginate(10);
            foreach($transfers as $transfer)
            {
                $transfer->transfer_status='In';
                $transfer->total_transfer_value= $this->total_transfer_value($transfer->id,$transfer->transfer_status);
                $transfer_total_value+=$this->total_transfer_value($transfer->id,$transfer->transfer_status);
            }
//            dd($transfers);
            if($transfers->isNotEmpty()){
                $data=view('Stock.transfer_status_filter',compact('transfers'));
            }else{
                $data="<tr>
                       <td colspan='3'>
                     <p style='margin-left: 350px;color:darkred;margin-top:30px'>Empty outcome stocks for your branch</p>
                       </td>
                  </tr>";
            }
            return $data;
        }elseif($status==="out"){
//            dd('out');
            $transfers=Transfer::with('currency','group_note')
                ->orderBy('id','desc')
                ->whereDate('date_time',$date)
                ->where(function($query) use($branch_id){
                    $query->where('from_branch_id',$branch_id)
                        ->where('to_branch_id','!=',$branch_id);
                })->paginate(10);
            foreach($transfers as $transfer)
            {
                $transfer->transfer_status='Out';
                $transfer->total_transfer_value= $this->total_transfer_value($transfer->id,$transfer->transfer_status);
                $transfer_total_value+=$this->total_transfer_value($transfer->id,$transfer->transfer_status);
            }
            if($transfers->isNotEmpty()){
                $data=view('    Stock.transfer_status_filter',compact('transfers'));
            }else{
                $data="<tr>
                       <td colspan='3'>
                     <p style='margin-left: 350px;color:darkred;margin-top:30px'>Empty outcome stocks for your branch</p>
                       </td>
                  </tr>";
            }
            return $data;
        }elseif($status==="add"){
//            dd("add");
            $transfers=Transfer::with('currency','group_note')
                ->orderBy('id','desc')
                ->whereDate('date_time',$date)
                ->where(function($query) use($branch_id){
                    $query->where('from_branch_id',$branch_id)
                        ->where('to_branch_id',$branch_id);
                })->paginate(10);
            foreach($transfers as $transfer)
            {
                $transfer->transfer_status='Add';
                $transfer->total_transfer_value= $this->total_transfer_value($transfer->id,$transfer->transfer_status);
                $transfer_total_value+=$this->total_transfer_value($transfer->id,$transfer->transfer_staus);
            }
//            dd($transfer);
            if($transfers->isNotEmpty()){
                $data=view('Stock.transfer_status_filter',compact('transfers'));
            }else{
                $data="<tr>
                       <td colspan='3'>
                     <p style='margin-left: 350px;color:darkred;margin-top:30px'>Empty outcome stocks for your branch</p>
                       </td>
                  </tr>";
            }
            return $data;
        }elseif($status==="all"){
//            dd("all");
             $transfers=Transfer::orderBy('id','desc')->whereDate('date_time',$date)
                 ->where(function($query) use($branch_id){
                     $query->where('from_branch_id',$branch_id)
                         ->orWhere('to_branch_id',$branch_id);
                 })
                 ->paginate(10);
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
                elseif($transfer->from_branch_id== $branch_id && $transfer->to_branch_id != $branch_id){
                    $transfer->transfer_status="Out";

                }

                $transfer->total_transfer_value= $this->total_transfer_value($transfer->id,$transfer->transfer_status);
                $transfer_total_value+=$this->total_transfer_value($transfer->id,$transfer->transfer_status );


            }
            if($transfers->isNotEmpty()){
                $data=view('Stock.transfer_status_filter',compact('transfers'));
            }else{
                $data="<tr>
                       <td colspan='3'>
                     <p style='margin-left: 350px;color:darkred;margin-top:30px'>Empty outcome stocks for your branch</p>
                       </td>
                  </tr>";
            }
            return $data;

        }
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
        elseif($to_branch_note->isEmpty() )
        {
            $to_result=intval($value);
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
//    *********************************Not Need**************************

    public function transfer_datepicker(Request $request)
    {
        $branch_id=Auth::user()->branch_id;
        $date=$request->date;
//        $transfers=$this->transfers($date);
        $transfers=Transfer::whereDate('date_time',$date)->get();
//        dd($transfers);
        $transfer_total_value=0;
        if($transfers->isNotEmpty())
        {
            foreach($transfers as $transfer)
            {
                if($transfer->to_branch_id == $branch_id && $transfer->from_branch_id ==$branch_id)
                {
//                    dd('add');
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

        }
        if($transfers->isNotEmpty()){
            $data=view('Stock.branch_filter_view',compact('transfers','total_value'));
        }else{
            $data="<p style='margin-left: 450px;color:darkred;margin-top:30px'>Empty stocks for your branch</p>";
        }
        return $data;
    }
    public function transfer_status_filter($value)
    {
        $branch_id=Auth::user()->branch_id;
        $transfer_total_value=0;
        if($value==1)
        {
            $transfers=Transfer::with('currency','group_note')
                ->orderBy('id','desc')
//                ->whereDate('date_time',Carbon::today())
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
//            dd($transfers);
            if($transfers->isNotEmpty()){
                $data=view('Stock.transfer_status_filter',compact('transfers'));
            }else{
                $data="<p style='margin-left: 450px;color:darkred;margin-top:30px'>Empty stocks for income</p>";
            }
            return $data;
        }

        elseif($value==2)
        {
            $transfers=Transfer::with('currency','group_note')
            ->orderBy('id','desc')
//                ->whereDate('date_time',Carbon::today())
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
            if($transfers->isNotEmpty()){
                $data=view('    Stock.transfer_status_filter',compact('transfers'));
            }else{
                $data="<p style='margin-left: 450px;color:darkred;margin-top:30px'>Empty outcome stocks for your branch</p>";
            }
            return $data;
        }
        elseif($value==3)
        {
            $transfers=Transfer::with('currency','group_note')
                ->orderBy('id','desc')
//                ->whereDate('date_time',Carbon::today())
                ->where(function($query) use($branch_id){
                    $query->where('from_branch_id',$branch_id)
                        ->where('to_branch_id',$branch_id);
                })->paginate(10);
//            dd($transfers);
            foreach($transfers as $transfer)
            {
                $transfer->transfer_status='Add';
                $transfer->total_transfer_value= $this->total_transfer_value($transfer->id);
                $transfer_total_value+=$this->total_transfer_value($transfer->id);
            }
//            dd($transfer);
            if($transfers->isNotEmpty()){
                $data=view('Stock.transfer_status_filter',compact('transfers'));
            }else{
                $data="<p style='margin-left: 450px;color:darkred;margin-top:30px'>Empty stocks </p>";
            }
            return $data;
        }
        elseif($value==4)
        {
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
            if($transfers->isNotEmpty()){
                $data=view('Stock.transfer_status_filter',compact('transfers'));
            }else{
                $data="<p style='margin-left: 450px;color:darkred;margin-top:30px'>Empty all stocks your branch</p>";
            }
            return $data;

//            return redirect('stock');
        }



    }

//    **********************************************************
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

//    public function get_branch()
//    {
//        $branch=Auth::user()->branch_id ? Auth::user()->branch_id : "admin_add";
//        return $branch;
//    }
//    public function get_transfer_branch()
//    {
//        $branch=Auth::user()->branch_id ? Auth::user()->branch_id : "admin_transfer";
//        return $branch;
//    }
}
