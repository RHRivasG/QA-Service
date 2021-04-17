<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $part = Role::create(['name'=>'participant']);
        $mod = Role::create(['name'=>'moderator']);

        Permission::create(['name' => 'question.create'])->assignRole($part);

        Permission::create(['name' => 'question.pending'])->assignRole($mod);
        Permission::create(['name' => 'question.denied'])->assignRole($mod);
        Permission::create(['name' => 'question.answer'])->assignRole($mod);
        Permission::create(['name' => 'question.deny'])->assignRole($mod);


    }
}
