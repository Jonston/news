<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use App\Services\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    protected ProfileService $profileService;
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $profile): View
    {
        return view('profile.edit', [
            'profile' => $profile,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfileRequest $request
     * @param User $profile
     * @return RedirectResponse
     */
    public function update(ProfileRequest $request, User $profile): RedirectResponse
    {
        $this->profileService->update($profile, $request->validated(), $request->file('avatar'));

        return redirect()->route('cabinet.profiles.edit', $profile);
    }

    /**
     * Remove the specified resource from storage.
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('home')->with('success', 'User deleted.');
    }
}
