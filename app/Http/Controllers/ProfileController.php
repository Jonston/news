<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use App\Services\ProfileService;
use Illuminate\Auth\Access\AuthorizationException;
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
     * @param User $profile
     * @return View
     * @throws AuthorizationException
     */
    public function edit(User $profile): View
    {
        $this->authorize('update', $profile);

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
     * @throws AuthorizationException
     */
    public function update(ProfileRequest $request, User $profile): RedirectResponse
    {
        $this->authorize('update', $profile);

        $this->profileService->update($profile, $request->validated(), $request->file('avatar'));

        return redirect()->route('cabinet.profiles.edit', $profile);
    }

    /**
     * Remove the specified resource from storage.
     * @param User $profile
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(User $profile): RedirectResponse
    {
        $this->authorize('delete', $profile);

        $profile->delete();

        return redirect()->route('home')->with('success', 'User deleted.');
    }
}
