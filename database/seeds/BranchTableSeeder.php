<?php

use Illuminate\Database\Seeder;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branches=['Branch1','Branch2','Branch3','Branch4','Supplier'];
        $phone_number=['09934949','093323232','0989888989','098988838','09993933'];

        foreach($branches as $key=>$branch)
        {
                \Illuminate\Support\Facades\DB::table('branches')->insert([
                    'name'=>$branch,
                    'address'=>"Mandalay",
                    'phone_number'=>$phone_number[$key],
                    'branch_type_id'=>$branch==="Supplier" ? 2 :1,
                ]);
        }
    }
}
