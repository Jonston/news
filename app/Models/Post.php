<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'author_id',
    ];

    protected $appends = [
        'date',
        'preview'
    ];

    /**
     * When deleting a post, delete all previews.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::deleting(function (Post $post) {
            if ($post->isForceDeleting()) {
                $post->previews()->each(function (Image $image) {
                    $image->delete();
                });
            }
        });
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * @return BelongsToMany
     */
    public function previews(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'post_image', 'post_id', 'image_id');
    }

    /**
     * @return Attribute
     */
    public function preview(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->previews->first(),
        );
    }

    /**
     * @return Attribute
     */
    public function date(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_at->format('d F Y H:i'),
        );
    }
}
