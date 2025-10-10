<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Post;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete all old companies and their posts
        \App\Models\Post::query()->delete();
        \App\Models\Company::query()->delete();

        // Get all categories
        $categories = \App\Models\CompanyCategory::all();

        // Example company data for each category
        $exampleCompanies = [
            [ 'title' => 'Grameenphone Ltd.', 'logo' => 'images/logo/gp.png' ],
            [ 'title' => 'bKash Limited', 'logo' => 'images/logo/bkash.png' ],
            [ 'title' => 'Square Group', 'logo' => 'images/logo/square.png' ],
            [ 'title' => 'PRAN-RFL Group', 'logo' => 'images/logo/pranrfl.png' ],
            [ 'title' => 'BRAC', 'logo' => 'images/logo/brac.png' ],
            [ 'title' => 'ACI Limited', 'logo' => 'images/logo/aci.png' ],
            [ 'title' => 'Robi Axiata Limited', 'logo' => 'images/logo/robi.png' ],
            [ 'title' => 'Walton Group', 'logo' => 'images/logo/walton.png' ],
            [ 'title' => 'Unilever Bangladesh', 'logo' => 'images/logo/unilever.png' ],
            [ 'title' => 'Banglalink', 'logo' => 'images/logo/banglalink.png' ],
            [ 'title' => 'City Bank', 'logo' => 'images/logo/citybank.png' ],
            [ 'title' => 'IFIC Bank', 'logo' => 'images/logo/ific.png' ],
            [ 'title' => 'LankaBangla Finance', 'logo' => 'images/logo/lankabangla.png' ],
            [ 'title' => 'Pathao', 'logo' => 'images/logo/pathao.png' ],
            [ 'title' => 'Daraz', 'logo' => 'images/logo/daraz.png' ],
            [ 'title' => 'Foodpanda', 'logo' => 'images/logo/foodpanda.png' ],
            [ 'title' => 'Uber Bangladesh', 'logo' => 'images/logo/uber.png' ],
            [ 'title' => 'Shwapno', 'logo' => 'images/logo/shwapno.png' ],
            [ 'title' => 'Beximco', 'logo' => 'images/logo/beximco.png' ],
            [ 'title' => 'Akij Group', 'logo' => 'images/logo/akij.png' ],
            // Add more as needed
        ];

        // Create one author per company and assign each company
        $authorAccounts = [];
        $shortCounts = [];
        foreach ($exampleCompanies as $companyData) {
            // 1. Create author user
            $short = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', explode(' ', $companyData['title'])[0]));
            if (!isset($shortCounts[$short])) {
                $shortCounts[$short] = 1;
            } else {
                $shortCounts[$short]++;
            }
            $email = $short . $shortCounts[$short] . '@example.com';
            $user = \App\Models\User::factory()->create([
                'name' => ucfirst($short) . $shortCounts[$short],
                'email' => $email,
                'password' => bcrypt('password'),
            ]);
            $user->assignRole('author');
            // 2. Create company with the new user's ID
            $company = Company::create([
                'title' => $companyData['title'],
                'logo' => $companyData['logo'],
                'company_category_id' => $categories->random()->id,
                'user_id' => $user->id,
                'description' => 'This is a sample company description for demo purposes.',
                'website' => 'https://www.example.com',
                'cover_img' => 'nocover',
            ]);
            $authorAccounts[] = [
                'company' => $company->title,
                'email' => $email,
                'password' => 'password',
            ];

            // Create at least one post for each company
            \App\Models\Post::factory()->create([
                'company_id' => $company->id,
                // Optionally customize job_title, deadline, etc. here
            ]);
        }
        // Output author accounts for reference
        file_put_contents(base_path('author_accounts.txt'), json_encode($authorAccounts, JSON_PRETTY_PRINT));
    }
}
