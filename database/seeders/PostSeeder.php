<?php

namespace Database\Seeders;

use App\DTO\Post\PostStoreData;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{

    public function __construct(
        private readonly PostRepositoryInterface $postRepository
    )
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <= 30; $i++) {
            $this->postRepository->create(
                PostStoreData::from([
                                        'user_id' => $i,
                                        'title'   => fake()->title,
                                        'body'    => fake()->text(256)
                                    ]
                ));
        }
    }
}
