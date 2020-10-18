<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    // public function definition()
    // {
    //     return [
    //         'name' => $this->faker->name,
    //         'email' => $this->faker->unique()->safeEmail,
    //         'email_verified_at' => now(),
    //         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    //         'remember_token' => Str::random(10),
    //     ];
    // }

    //User Guru
    public function definition()
    {
        $username = $this->faker->unique()->randomNumber(18);
        return [
            'name' => "Guru " . $this->faker->name,
            'email' => $username,
            'email_verified_at' => now(),
            'password' => Hash::make($username),
        ];
    }
}