<?php

namespace Database\Seeders;

use App\Models\UserModel;
use App\Models\TopicModel;
use App\Models\CommentModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // UserModel::factory()->count(10)->create();
        // TopicModel::factory()->count(10)->create();
        // CommentModel::factory()->count(10)->create();

        UserModel::factory()->has(
                TopicModel::factory()->has(
                        CommentModel::factory()->count(20), 'comments'
                    )->count(20), 'topics'
            )->count(20)->create();
    }
}
