<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create admin user
        $role_admin = new Role();
        $role_admin->name = "admin";
        $role_admin->description = "an Administrator user";
        $role_admin->save();

        // create normal user
        $role_user = new Role();
        $role_user->name = "user";
        $role_user->description = "an Ordinary user";
        $role_user->save();

    }
}
