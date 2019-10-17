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
            'name'=>'Bronze',
        ]);
        \App\Model\MemberType::create([
            'name'=>'Silver',
        ]);
        \App\Model\MemberType::create([
            'name'=>'Gold',
        ]);
        \App\Model\MemberType::create([
            'name'=>'Platinum',
        ]);
        \App\Model\MemberType::create([
            'name'=>'Diamond',
        ]);
        \App\Model\MemberType::create([
            'name'=>'Crown',
        ]);
    }
}
