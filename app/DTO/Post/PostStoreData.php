<?php

namespace App\DTO\Post;

use Spatie\LaravelData\Data;

class PostStoreData extends Data
{
    public function __construct(
        public string $title,
        public string $body,
        public int    $user_id,
    )
    {
    }
}
