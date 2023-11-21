<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;

class ImageController extends Controller
{
    public function random(): JsonResponse
    {
        $imageService = new ImageService();

        $width = 800;
        $height = 600;

        if (mt_rand(0, 1)) {
            [$width, $height] = [$height, $width];
        }

        $image = $imageService->random($width, $height);
        $imageModel = $imageService->create($image, 'tmp', true);

        return response()->json([
            'image' => $imageModel,
        ]);
    }
}
