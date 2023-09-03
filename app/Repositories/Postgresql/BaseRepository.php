<?php

namespace App\Repositories\Postgresql;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    /**
     * BaseRepository constructor.
     *
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * @param $id
     *
     * @return Model
     */
    public function findOrFail($id): Model
    {
        return $this->model->query()
            ->findOrFail($id);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function delete($id): bool
    {
        return $this->model->destroy($id);
    }

    /**
     * @param int $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage): LengthAwarePaginator
    {
        return $this->model->query()
            ->orderByDesc('id')
            ->paginate($perPage);
    }

    abstract protected function setModel(): void;
}
