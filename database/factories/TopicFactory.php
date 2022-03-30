<?php

namespace Database\Factories;

use App\Models\TopicModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TopicModel>
 */
class TopicFactory extends Factory
{
    protected $model = TopicModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'     => rand(1, 50),
            'type'        => 1,
            'content'     => $this->faker->text(),
            'hot'         => 0,
            'is_digest'   => 0,
            'status'      => 0,
            'remark'      => '',
            'ip'          => $this->faker->ipv4,
            'device_type' => 1,
            'device_id'   => $this->faker->uuid(),
            'deleted_at'  => null,
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }
}
