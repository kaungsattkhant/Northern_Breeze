<?php

use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency_type=[
            'Australian dollar',
            'Brunei dollar',
            'Chinese Yuan Renminbi',
            'European euro',
            'Hong Kong dollar',
            'Indian rupee',
            'Indonesian rupiah',
            'Japanese yang',
            'Macanese pataca',
            'Malaysia ringgit',
            'Myanmar Kyat',
            'Philippine peso',
            'Singapore Dollar',
            'South Korea won',
            'Swedish krona',
            'Thai baht',
            'UAE dirham',
            'Pound Sterling',
            'United States dollar',
            'Vietnamese dong'

        ];
        for($i=0;$i<count($currency_type);$i++)
        {
            \Illuminate\Support\Facades\DB::table('currencies')->insert([
                'name'=>$currency_type[$i],
            ]);
        }
    }
}
