<?php

namespace App\Repositories\Interfaces;


use App\DTO\User\UserStoreData;
use App\Models\User;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param UserStoreData $data
     *
     * @return User|null
     */
    public function create(UserStoreData $data): User|null;
}
