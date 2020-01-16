<?php

use Illuminate\Database\Seeder;
use App\Model\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'=>'Admin'
        ]);
        Role::create([
            'name'=>'Manager'
        ]);
        Role::create([
            'name'=>'Front Man'
        ]);
    }
}
