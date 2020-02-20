<?php
namespace App\Http\Traits;
use App\Model\Member;
use App\Model\MemberType;
use Carbon\Carbon;
trait MemberPointYear{
    public function member_point_year(){
        $year=config('global.point_expire_of_year');
        $members=Member::with('member_type')->get();
        foreach($members as $m){
            $member=Member::find($m->id);
            $d=Carbon::create($member->date_for_point_changes);
            $res=$member->updated_at->diffInYears($d);
            $mt=MemberType::find($member->member_type_id);
            if($mt->name==="Starter"){
                if($res<=$year && $member->points>=1000 ){
                    $member->update([
                        'member_type_id'=>((int)$mt->id+1),
                        'date_for_point_changes'=>now(),
                    ]);

                }elseif($res==$year  && $member->points<1000 ){
                    $member->update([
                        'points'=>$mt->points,
                    ]);

                }
            }
            elseif($mt->name==="Blue"){
                if($res<=$year && $member->points>=3000 ){
                    $member->update([
                        'member_type_id'=>((int)$mt->id+1),
                        'date_for_point_changes'=>now(),
                    ]);

                }elseif($res==$year  && $member->points<3000 ){
                    $member->update([
                        'points'=>$mt->points,
                    ]);

                }

            }
            elseif($mt->name==="Gold"){
                if($res<=$year && $member->points>=5000 ){
                    $member->update([
                        'member_type_id'=>((int)$mt->id+1),
                        'date_for_point_changes'=>now(),
                    ]);

                }elseif($res==$year  && $member->points<5000 ){
                    $member->update([
                        'points'=>$mt->points,
                    ]);

                }

            }
            elseif($mt->name==="Platinum"){
                if($res<=$year && $member->points>=9000 ){
                    $member->update([
                        'member_type_id'=>((int)$mt->id+1),
                        'date_for_point_changes'=>now(),
                    ]);

                }elseif($res==$year  && $member->points<9000 ){
                    $member->update([
                        'points'=>$mt->points,
                    ]);

                }

            }
        }


    }
}
?>

