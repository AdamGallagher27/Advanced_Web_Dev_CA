<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create admin user in pivot tasble
        $admin = new UserRole();
        $admin->user_id = 1;
        $admin->role_id = 1;
        $admin->save();

        
        // create normal user in pivot tasble
        $user = new UserRole();
        $user->user_id = 2;
        $user->role_id = 2;
        $user->save();

        
        // create reviewer user in pivot tasble
        $reviewer = new UserRole();
        $reviewer->user_id = 3;
        $reviewer->role_id = 3;
        $reviewer->save();


    }
}
