<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // Other seeders if you have them
        ]);

        // Use the factory here
// Use the factory here
    Employee::factory()->times(20)->create();
    $this->call(adminseeder::class);
    $this->call(PermissionsSeeder::class);
    $this->call(SuperAdminPermissionsSeeder::class);

    }
}
