<?php

namespace Database\Factories;

use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RoleUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RoleUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userid = User::where('name', '%like', 'Guru')->get()->first()->id;
        return [
            'role_id' => 3,
            'user_id' => $userid,
            'user_type' => "App\Models\User"
        ];
    }
}
