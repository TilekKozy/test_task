<?php

namespace App\Repositories\External;

use App\DTO\Post\PostStoreData;
use App\DTO\Post\PostUpdateData;
use App\Repositories\Interfaces\ExternalPostRepositoryInterface;

final class PostRepository extends BaseRepository implements ExternalPostRepositoryInterface
{
    protected const MODEL = 'posts/';

    public function create(PostStoreData $data): object|null
    {
        $response = $this->http::asJson()
            ->post($this->url().'add', [
                'title'  => $data->title,
                'body'   => $data->body,
                'userId' => $data->user_id
            ])
            ->json();

        return (object)[
            'dummy_post_id' => $response['id']
        ];
    }

    public function update(int $id, PostUpdateData $data): bool
    {
        $status = $this->http::asJson()
            ->put($this->url().$id, [
                'title'  => $data->title,
                'body'   => $data->body,
                'userId' => $data->user_id
            ])
            ->status();
        return $status === 200;
    }
}
