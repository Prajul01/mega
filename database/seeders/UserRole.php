<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'super-admin',
            'employer',
            'job-seeker'
        ];
        
        foreach($roles as $role)
        {
            Role::create(['name' => $role]);
        }

        $user = User::first();
        $user->assignRole(1);
    }
}
