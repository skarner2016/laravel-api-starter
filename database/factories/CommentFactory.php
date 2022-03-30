<?php

namespace Database\Factories;

use App\Models\CommentModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommentModel>
 */
class CommentFactory extends Factory
{
    protected $model = CommentModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'          => rand(1, 50),
            'topic_id'         => rand(1, 50),
            'reply_comment_id' => rand(0, 10),
            'reply_user_id'    => rand(1, 50),
            'root_comment_id'  => 0,
            'content'          => $this->faker->text,
            'is_digest'        => rand(0, 1),
            'status'           => 0,
            'remark'           => '',
            'ip'               => $this->faker->ipv4,
            'device_type'      => 1,
            'device_id'        => $this->faker->uuid,
            'deleted_at'       => null,
            'created_at'       => now(),
            'updated_at'       => now(),
        ];
    }
}
