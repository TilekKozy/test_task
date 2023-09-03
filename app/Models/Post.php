<?php

namespace App\Models;

use App\Repositories\External\PostRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int         $id
 * @property int         $user_id
 * @property int         $dummy_post_id
 * @property Carbon|null $deleted_at
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 */
class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'dummy_post_id'
    ];

    protected $appends = [
        'title',
        'short_body',
        'body'
    ];

    /**
     * @return string
     * @throws BindingResolutionException
     */
    public function getTitleAttribute(): string
    {
        return $this->getExternalData()?->title;
    }

    /**
     * @return string
     * @throws BindingResolutionException
     */
    public function getShortBodyAttribute(): string
    {
        return substr(
            string: $this->getExternalData()?->body,
            offset: 0,
            length: 128
        );
    }

    /**
     * @return string
     * @throws BindingResolutionException
     */
    public function getBodyAttribute(): string
    {
        return $this->getExternalData()?->body;
    }

    /**
     * @return object
     * @throws BindingResolutionException
     */
    public function getExternalData(): object
    {
        //todo здесь должен быть $this->dummy_post_id но новые посты не создаются
        return (app()->make((PostRepository::class)))->findOrFail($this->id);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
