<?php

use Illuminate\Database\Seeder;

class MemberTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\MemberType::create([
            'name'=>'Starter',
            'points'=>0
        ]);
        \App\Model\MemberType::create([
            'name'=>'Blue',
            'points'=>1000,
        ]);
        \App\Model\MemberType::create([
            'name'=>'Gold',
            'points'=>3000,
        ]);
        \App\Model\MemberType::create([
            'name'=>'Platinum',
            'points'=>5000,
        ]);
        \App\Model\MemberType::create([
            'name'=>'Diamond',
            'points'=>9000,
        ]);
    }
}
