<?php

namespace Database\Factories;

use App\Models\UserProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'full_name' => $this->faker->name,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'dob' => $this->faker->date,
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'nationality' => $this->faker->country,
            'about' => $this->faker->paragraph,
            'profile_pic' => $this->faker->imageUrl,
            'cv' => $this->faker->url,
            'education' => $this->faker->paragraph,
            'experience' => $this->faker->paragraph,
            'skills' => $this->faker->words(3, true),
            'references' => $this->faker->paragraph,
        ];
    }
}
