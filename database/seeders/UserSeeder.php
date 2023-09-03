<?php

namespace Database\Seeders;

use App\DTO\User\UserStoreData;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    )
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <= 30; $i++) {
            $this->userRepository->create(
                UserStoreData::from([
                                        'name'     => fake()->name,
                                        'email'    => fake()->email,
                                        'password' => 'password'
                                    ])
            );
        }
    }
}
