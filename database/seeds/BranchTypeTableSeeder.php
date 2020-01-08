<?php

use Illuminate\Database\Seeder;

class BranchTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\BranchType::create([
            'name'=>'self_branch',
        ]);
        \App\Model\BranchType::create([
            'name'=>'supplier',
        ]);
    }
}
