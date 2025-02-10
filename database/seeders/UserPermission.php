<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');
        $old = Permission::all();

        foreach($old as $data)
        {
            $data->delete();
        }

        $permissions = [
            'site-list',
            'site-create',
            'site-edit',
            'site-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'report-list',
            'content-list',
            'content-create',
            'content-edit',
            'content-delete',
            'location-list',
            'location-create',
            'location-edit',
            'location-delete',
            'job-list',
            'job-create',
            'job-edit',
            'job-delete',
            'education-list',
            'education-create',
            'education-edit',
            'education-delete',
            'company-list',
            'company-create',
            'company-edit',
            'company-delete',
            'employer-list',
            'employer-create',
            'employer-edit',
            'employer-delete',
            'tender-list',
            'tender-create',
            'tender-edit',
            'tender-delete',
            'career-list',
            'career-create',
            'career-edit',
            'career-delete',
        ];
        // $role = Role::where('name', 'super-admin')->first();


        foreach ($permissions as $permission) {
            $data = new Permission;
            $data->name = $permission;
            $data->save();
        }

        // $user = \App\Models\User::find(1);
        // $role = Role::find(1);   

        // $permissions = Permission::pluck('id', 'id')->all();

        // $role->syncPermissions($permissions);
        // $user->assignRole($role->id);
    }
}