<?php

namespace App\Repositories\Interfaces;


use App\DTO\Post\PostStoreData;
use App\DTO\Post\PostUpdateData;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

interface ExternalPostRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param PostStoreData $data
     *
     * @return Model|null
     */
    public function create(PostStoreData $data): object|null;


    /**
     * @param int            $id
     * @param PostUpdateData $data
     *
     * @return Post|null
     */
    public function update(int $id, PostUpdateData $data):bool;
}
