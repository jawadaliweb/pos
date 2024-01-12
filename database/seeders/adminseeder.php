<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a new user
        $user = User::create([
            'name' => 'jawad',
            'phone' => '03109665343',
            'email' => 'jawad.ali@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
        ]);

        // Create the 'super admin' role (if it doesn't exist)
        $superAdminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'super admin']);

        // Assign the 'super admin' role to the user
        $user->assignRole($superAdminRole);
    }
}
