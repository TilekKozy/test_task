<?php

namespace App\Repositories\Postgresql;

use App\DTO\User\UserStoreData;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

final class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    protected function setModel(): void
    {
        $this->model = new User();
    }

    public function create(UserStoreData $data): User|null
    {
        return $this->model->create(
            [
                'name'     => $data->name,
                'email'    => $data->email,
                'password' => Hash::make($data->password),
            ]
        );
    }
}
