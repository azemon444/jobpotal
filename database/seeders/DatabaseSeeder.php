<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
            CategorySeeder::class,
            RolePermissionSeeder::class,
            CompanySeeder::class,
            UserSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();        
        
        // Automatically update job skills and locations after seeding
        \Artisan::call('jobs:update-skills-locations');
    }
}
