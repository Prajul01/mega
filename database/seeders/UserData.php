<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'KTM Rush Admin',
            'email' => 'ktmrushservices@gmail.com',
            'password' => bcrypt('K@THSecretK3y'),
        ]);

           }
}
