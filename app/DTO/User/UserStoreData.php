<?php

namespace App\DTO\User;

use Spatie\LaravelData\Data;

class UserStoreData extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    )
    {
    }
}
