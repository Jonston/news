<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Intervention\Image\Image as ImageIntervention;

class ImageService
{
    public function __construct()
    {
        $this->source = 'https://source.unsplash.com/random';
    }

    public function random(int $width = 800, int $height = 600, int $quality = 90): ImageIntervention
    {
        $source = $this->source . '/' . $width . 'x' . $height . '/?nature';

        return Image::make($source)->encode('jpg', $quality);
    }

    public function save(ImageIntervention $image, string $path): string
    {
        Storage::disk('public')->put($path, $image);

        return Storage::url($path);
    }
}
