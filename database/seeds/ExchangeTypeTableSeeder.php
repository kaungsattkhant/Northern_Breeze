<?php

use Illuminate\Database\Seeder;

class ExchangeTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\ExchangeType::create([
            'name'=>'Personal'
        ]);
        \App\Model\ExchangeType::create([
            'name'=>'Business'
        ]);
    }
}
