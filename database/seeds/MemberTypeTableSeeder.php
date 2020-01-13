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
        ]);
        \App\Model\MemberType::create([
            'name'=>'Gold',
        ]);
        \App\Model\MemberType::create([
            'name'=>'Premium',
        ]);
    }
}
