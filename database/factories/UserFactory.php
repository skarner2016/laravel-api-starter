<?php

namespace Database\Factories;

use App\Models\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserModel>
 */
class UserFactory extends Factory
{
    protected $model = UserModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mobile' => $this->faker->phoneNumber,
            'name' => $this->faker->unique()->name(),
            'status' => UserModel::STATUS_DEFAULT,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
