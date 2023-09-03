<?php

namespace App\Repositories\Interfaces;

use \Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param int $id
     *
     * @return object|null
     */
    public function findOrFail(int $id): object|null;

    /**
     * @param $id
     *
     * @return bool
     */
    public function delete($id): bool;

}
