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
        $branches=['Branch1','Branch2','Branch3','Branch4'];
        foreach($branches as $branch)
        {
            \Illuminate\Support\Facades\DB::table('branches')->insert([
                'name'=>$branch,
            ]);
        }
    }
}
