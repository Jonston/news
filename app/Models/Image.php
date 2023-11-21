<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'tmp'
    ];

    protected $appends = [
        'url'
    ];

    protected static function booted(): void
    {
        static::deleting(function ($tmpImage) {
            Storage::disk('public')->delete($tmpImage->path);
        });
    }


    /**
     * @param string $to
     * @return void
     * @throws \Exception
     */
    public function move(string $to): void
    {
        $moved = Storage::disk('public')->move($this->path, $to);

        if ( ! $moved) {
            throw new \Exception('Failed to move image.');
        }

        $this->path = $to;
        $this->save();
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::url($this->path)
        );
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}
