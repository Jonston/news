<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Intervention\Image\Image as ImageIntervention;
use App\Models\Image as ImageModel;

class ImageService
{
    public function __construct()
    {
        $this->source = 'https://source.unsplash.com/random';
    }

    /**
     * Get a random image from Unsplash.
     *
     * @param int $width
     * @param int $height
     * @param int $quality
     * @return ImageIntervention
     */
    public function random(int $width = 800, int $height = 600, int $quality = 90): ImageIntervention
    {
        $source = $this->source . '/' . $width . 'x' . $height . '/?nature';

        return Image::make($source)->encode('jpg', $quality);
    }

    /**
     * Save an image to storage.
     *
     * @param ImageIntervention|UploadedFile $image
     * @param string $path
     * @param bool $tmp
     * @return ImageModel
     */
    public function create(ImageIntervention|UploadedFile $image, string $path, bool $tmp = false): ImageModel
    {
        $path = trim($path, '/') . '/' . uniqid(more_entropy: true) . '.jpg';

        if ($image instanceof UploadedFile) {
            $image->storeAs('public', $path);
        } else {
            Storage::disk('public')->put($path, $image);
        }

        $name = basename($path);

        return ImageModel::create([
            'name' => $name,
            'path' => $path,
            'tmp' => $tmp,
        ]);
    }
}
