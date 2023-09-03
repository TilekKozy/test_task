<?php

namespace App\Repositories\External;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected const URL = 'https://dummyjson.com/';

    public function __construct(
        protected Http $http
    )
    {
    }


    protected function url(): string
    {
        return self::URL.static::MODEL;
    }

    /**
     * @param $id
     *
     * @return object|null
     */
    public function findOrFail($id): object|null
    {
        return Cache::rememberForever(
            key: "external_post_$id",
            callback: fn() => (object)$this->http::asJson()
                ->get($this->url().$id)
                ->json()
        );
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {

        return collect($this->http::asJson()
                           ->get($this->url()));
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function delete($id): bool
    {
        $response = $this->http::asJson()
            ->delete($this->url().$id);
        return $response->body();
    }
}
