<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;

class ProfileService
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function update(User $profile, array $data, UploadedFile $avatar = null): void
    {
        $profile->name = $data['name'];
        $profile->email = $data['email'];

        if ($avatar) {
            $image = $this->imageService->create($avatar, 'avatars');
            $profile->avatar?->delete();
            $profile->images()->attach($image);
        }

        $profile->save();
    }
}
