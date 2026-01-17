<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testHomePageLoadsWithData()
    {
        // Create some test data
        $category = \App\Models\CompanyCategory::factory()->create();
        $company = \App\Models\Company::factory()->create(['company_category_id' => $category->id]);
        \App\Models\Post::factory()->create(['company_id' => $company->id]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewHas(['posts', 'categories', 'topEmployers']);
    }
}
