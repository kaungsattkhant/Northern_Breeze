<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(MemberTypeTableSeeder::class);
        $this->call(ExchangeTypeTableSeeder::class);
        $this->call(StaffTableSeeder::class);
    }
}
