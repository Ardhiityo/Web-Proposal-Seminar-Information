<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'visitor'
            ],
            [
                'name' => 'admin'
            ],
        ];

        $permissions = [
            'academic_calendars' => [
                'c' =>  'create-academic-calendar',
                'r' => 'read-academic-calendar',
                'u' => 'update-academic-calendar',
                'd' => 'delete-academic-calendar'
            ],
            'proposals' => [
                'c' => 'create-proposal',
                'r' => 'read-proposal',
                'u' => 'update-proposal',
                'd' => 'delete-proposal'
            ],
            'students' => [
                'c' => 'create-student',
                'r' => 'read-student',
                'u' => 'update-student',
                'd' => 'delete-student'
            ],
            'rooms' => [
                'c' => 'create-room',
                'r' => 'read-room',
                'u' => 'update-room',
                'd' => 'delete-room'
            ],
            'lectures' => [
                'c' => 'create-lecture',
                'r' => 'read-lecture',
                'u' => 'update-lecture',
                'd' => 'delete-lecture'
            ]
        ];

        foreach ($roles as $key => $role) {
            Role::create(['name' => $role['name']]);
        }

        foreach ($permissions as $module => $permission) {
            foreach ($permission as $action => $permissionName) {
                Permission::create(['name' => $permissionName]);
                Role::findByName('admin')->givePermissionTo($permissionName);
                if ($action === 'r') {
                    Role::findByName('visitor')->givePermissionTo($permissionName);
                }
            }
        }

        User::create([
            'name' => 'admin',
            'email' => 'admin@test',
            'password' => 11111111
        ])->assignRole('admin');

        User::create([
            'name' => 'visitor',
            'email' => 'visitor@test',
            'password' => 11111111
        ])->assignRole('visitor');
    }
}
