<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $jobTitles = [
            'Software Engineer', 'Sales Executive', 'Marketing Manager', 'Graphic Designer',
            'HR Officer', 'Accountant', 'Customer Support', 'Business Analyst',
            'Project Manager', 'Content Writer', 'Data Analyst', 'Network Engineer',
            'Operations Manager', 'Product Manager', 'Web Developer', 'Mobile App Developer'
        ];
        $jobLevels = ['Entry level', 'Mid level', 'Senior level', 'Manager', 'Lead'];
        return [
            'company_id' => \App\Models\Company::inRandomOrder()->first()?->id ?? 1,
            'job_title' => $this->faker->randomElement($jobTitles),
            'job_level' => $this->faker->randomElement($jobLevels),
            'vacancy_count' => rand(2, 10),
            'employment_type' => 'Full time',
            'job_location' => $this->faker->city . ', Bangladesh',
            'deadline' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s") . " +2 days")),
            'education_level' => 'Bachelors',
            'experience' => $this->faker->numberBetween(1, 8) . ' years',
            'salary' => $this->faker->numberBetween(15, 80) . 'k - ' . $this->faker->numberBetween(81, 150) . 'k',
            'skills' => $this->faker->words(3, true),
            'specifications' => '<p></p>',
        ];
    }
}
