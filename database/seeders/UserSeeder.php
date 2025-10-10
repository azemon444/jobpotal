<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admin and a simple user
        $admin = User::factory()->create([
            'name' => 'admin user',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        $simple = User::factory()->create([
            'name' => 'simple user',
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
        ]);
        $simple->assignRole('user');


        // Create a job application for the first post of every company as the demo user
        $demoUser = \App\Models\User::where('email', 'user@user.com')->first();
        if ($demoUser) {
            foreach (\App\Models\Company::all() as $company) {
                $post = \App\Models\Post::where('company_id', $company->id)->first();
                if ($post) {
                    \App\Models\JobApplication::firstOrCreate([
                        'user_id' => $demoUser->id,
                        'post_id' => $post->id,
                    ]);
                }
            }
        }
    }
}
