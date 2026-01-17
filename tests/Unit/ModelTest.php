<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Company;
use App\Models\Post;
use App\Models\JobApplication;
use App\Models\CompanyCategory;
use App\Models\PostUser;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModelTest extends TestCase
{
    use RefreshDatabase;

    public function testUserRelationships()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create(['user_id' => $user->id]);
        $post = Post::factory()->create(['company_id' => $company->id]);

        $this->assertInstanceOf(Company::class, $user->company);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $user->posts);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $user->applied);
    }

    public function testCompanyRelationships()
    {
        $category = CompanyCategory::factory()->create();
        $company = Company::factory()->create(['company_category_id' => $category->id]);

        $this->assertInstanceOf(CompanyCategory::class, $company->getCategory);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $company->posts);
    }

    public function testPostMethods()
    {
        $post = Post::factory()->create([
            'deadline' => now()->addDays(5)->toDateString(),
            'skills' => 'PHP,Laravel,JavaScript'
        ]);

        $this->assertIsInt($post->deadlineTimestamp());
        $this->assertIsInt($post->remainingDays());
        $this->assertIsArray($post->getSkills());
        $this->assertEquals(['PHP', 'Laravel', 'JavaScript'], $post->getSkills());
    }

    public function testJobApplicationRelationships()
    {
        $application = JobApplication::factory()->create();

        $this->assertInstanceOf(Post::class, $application->post);
        $this->assertInstanceOf(User::class, $application->user);
    }

    public function testCompanyCategoryGuarded()
    {
        $category = CompanyCategory::factory()->create(['category_name' => 'Tech']);

        $this->assertEquals('Tech', $category->category_name);
    }

    public function testPostUserPivot()
    {
        $pivot = PostUser::factory()->create();

        $this->assertNotNull($pivot->post_id);
        $this->assertNotNull($pivot->user_id);
        $this->assertFalse($pivot->timestamps);
    }

    public function testUserProfileRelationships()
    {
        $profile = UserProfile::factory()->create();

        $this->assertInstanceOf(User::class, $profile->user);
    }
}
