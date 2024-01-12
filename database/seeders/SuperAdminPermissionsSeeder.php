<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class SuperAdminPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Find or create the 'super admin' role
        $superAdminRole = Role::firstOrCreate(['name' => 'super admin']);

        // Define the permissions to assign to the 'super admin' role
        $permissionsToAssign = [
            'pos.view',
            'pos.add',
            'pos.update',
            'pos.delete',
            'employee.view',
            'employee.add',
            'employee.update',
            'employee.delete',
            'customer.view',
            'customer.add',
            'customer.update',
            'customer.delete',
            'supplier.view',
            'supplier.add',
            'supplier.update',
            'supplier.delete',
            'salary.view',
            'salary.add',
            'salary.update',
            'salary.delete',
            'attendance.view',
            'attendance.add',
            'attendance.update',
            'attendance.delete',
            'category.view',
            'category.add',
            'category.update',
            'category.delete',
            'product.view',
            'product.add',
            'product.update',
            'product.delete',
            'expense.view',
            'expense.add',
            'expense.update',
            'expense.delete',
            'orders.view',
            'orders.add',
            'orders.update',
            'orders.delete',
            'stock.view',
            'stock.add',
            'stock.update',
            'stock.delete',
            'roles.view',
            'roles.add',
            'roles.update',
            'roles.delete',
        ];

        // Assign the permissions to the 'super admin' role
        $superAdminRole->syncPermissions($permissionsToAssign);
    }
}
