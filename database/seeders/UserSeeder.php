<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // admin role from role table
        $role_admin = Role::where("name", "admin")->first();

        // user role from roles table
        $role_user = Role::where("name", "user")->first();

        // user role from roles table
        $role_reviewer = Role::where("name", "reviewer")->first();


        // create new admin
        $admin = new User();
        $admin->name = "Admin";
        $admin->email = "admin@gmail.com";
        $admin->password = Hash::make("password");
        $admin->save();

        // attach admin role to the admin user
        $admin->roles()->attach($role_admin);


        // create new user
        $user = new User();
        $user->name = "User";
        $user->email = "user@gmail.com";
        $user->password = Hash::make("password");
        $user->save();

        // attach user role to the ordinary user 
        $user->roles()->attach($role_user);


        // create new reviewer
        $reviewer = new User();
        $reviewer->name = "Reviewer";
        $reviewer->email = "reviewer@gmail.com";
        $reviewer->password = Hash::make("password");
        $reviewer->save();

        // attach reviewer role to the ordinary user 
        $reviewer->roles()->attach($role_reviewer);

    }
}
