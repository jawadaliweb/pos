<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission; 

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // Permission format: group_name.name
            'pos' => ['view', 'add', 'update', 'delete'],
            'employee' => ['view', 'add', 'update', 'delete'],
            'customer' => ['view', 'add', 'update', 'delete'],
            'supplier' => ['view', 'add', 'update', 'delete'],
            'salary' => ['view', 'add', 'update', 'delete'],
            'attendance' => ['view', 'add', 'update', 'delete'],
            'category' => ['view', 'add', 'update', 'delete'],
            'product' => ['view', 'add', 'update', 'delete'],
            'expense' => ['view', 'add', 'update', 'delete'],
            'orders' => ['view', 'add', 'update', 'delete'],
            'stock' => ['view', 'add', 'update', 'delete'],
            'roles' => ['view', 'add', 'update', 'delete'],
        ];

        foreach ($permissions as $group => $permissionNames) {
            foreach ($permissionNames as $permissionName) {
                $permission = Permission::create([
                    'name' => "$group.$permissionName",
                    'guard_name' => 'web', // Replace with your guard name
                    'group_name' => $group,
                ]);
            }
        }
    
    }
}
