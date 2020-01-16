<?php

use Illuminate\Database\Seeder;

class NoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notes=[
            '1','2','5','10','20','30','50','100','150','200','500','1000','2000','5000','10000','20000','50000','100000','200000','500000'
        ];
        for($i=0;$i<count($notes);$i++)
        {
            \Illuminate\Support\Facades\DB::table('notes')->insert([
                'name'=>$notes[$i],
            ]);

        }

    }
}
