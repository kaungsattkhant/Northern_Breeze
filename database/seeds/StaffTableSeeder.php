<?php

use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Staff::create([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('password'),
            'role_id'=>1,
            'branch_id'=>1,
        ]);
        \App\Model\Staff::create([
            'name'=>'Manager',
            'email'=>'manager@gmail.com',
            'password'=>bcrypt('password'),
            'role_id'=>2,
            'branch_id'=>2,
        ]);
        \App\Model\Staff::create([
            'name'=>'Front Man',
            'email'=>'frontman@gmail.com',
            'password'=>bcrypt('password'),
            'role_id'=>3,
            'branch_id'=>3,
        ]);
    }
}
