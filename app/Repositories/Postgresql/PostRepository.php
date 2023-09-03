<?php

namespace App\Repositories\Postgresql;

use App\DTO\Post\PostStoreData;
use App\DTO\Post\PostUpdateData;
use App\Models\Post;
use App\Repositories\Interfaces\ExternalPostRepositoryInterface;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

final class PostRepository extends BaseRepository implements PostRepositoryInterface
{

    public function __construct(
        private readonly ExternalPostRepositoryInterface $externalPostRepository
    )
    {
        parent::__construct();
    }

    /**
     * @param PostStoreData $data
     *
     * @return Model|null
     * @throws \Exception
     */
    public function create(PostStoreData $data): object|null
    {
        DB::beginTransaction();
        try {
            $externalPost = $this->externalPostRepository->create($data);

            /** @var Post $post */
            $post = $this->model->query()
                ->create([
                             'user_id'       => $data->user_id,
                             //todo dummyJson не создает новые посты поэтому тут рандом вместо $externalPost->id
                             'dummy_post_id' => rand(1,150)
                         ]);


        } catch(\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }

        DB::commit();

        return (object)[
            'id'         => $post->id,
            'title'      => $data->title,
            'body'       => $data->body,
            'deleted_at' => $post->deleted_at,
            'created_at' => $post->created_at,
            'updated_at' => $post->updated_at
        ];
    }

    /**
     * @param int            $id
     * @param PostUpdateData $data
     *
     * @return bool
     * @throws \Exception
     */
    public function update(int $id, PostUpdateData $data): bool
    {
        DB::beginTransaction();
        try {
            $this->model->query()
                ->findOrFail($id)
                ->update([
                             'updated_at' => now()
                         ]);

            $result = $this->externalPostRepository->update($id, $data);

            Cache::forget("external_post_$id");

        } catch(\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }

        DB::commit();

        return $result;
    }

    public function delete($id): bool
    {
        Cache::forget("external_post_$id");
        return parent::delete($id);
    }

    protected function setModel(): void
    {
        $this->model = new Post();
    }
}
