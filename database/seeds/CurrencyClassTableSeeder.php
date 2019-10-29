<?php

use Illuminate\Database\Seeder;

class CurrencyClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes=['Class-A','Class-2','Class-3','Class-4'];
        for($i=0;$i<count($classes);$i++)
        {
            \Illuminate\Support\Facades\DB::table('classifications')->insert([
                'name'=>$classes[$i],
        ]);
        }

    }
}
