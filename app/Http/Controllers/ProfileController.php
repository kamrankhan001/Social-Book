<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\UserResource;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        return Inertia::render('Profile/View', [
            'mustVerifyEmail' => $user instanceof MustVerifyEmail,
            'status' => session('status'),
            'user' => new UserResource($user),
        ]);
    }

    public function coverUpdate(Request $request, User $user)
    {
        $request->validate(
            [
                'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'cover.image' => 'The file must be an image.',
                'cover.mimes' => 'The cover image must be a file of type: jpeg, png, jpg, gif, svg.',
                'cover.max' => 'The cover image must not be greater than 2MB.',
            ],
        );

        if ($request->hasFile('cover')) {
            // Delete the old cover image if exists
            if ($user->cover_image) {
                Storage::delete($user->cover_image);
            }

            // Store the new cover image
            $path = $request->file('cover')->store('covers', 'public');

            // Update user with new cover image path
            $user->update([
                'cover_image' => $path,
            ]);
        }

        return to_route('profile', ['user'=>$user])->with('success', 'Cover image updated successfully.');
    }
    
    public function avaterUpdate(Request $request, User $user)
    {
        $request->validate(
            [
                'avater' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'avater.image' => 'The file must be an image.',
                'avater.mimes' => 'The avater image must be a file of type: jpeg, png, jpg, gif, svg.',
                'avater.max' => 'The avater image must not be greater than 2MB.',
            ],
        );

        if ($request->hasFile('avater')) {
            // Delete the old avater if exists
            if ($user->avater_image) {
                Storage::delete($user->avater_image);
            }

            // Store the avater image
            $path = $request->file('avater')->store('avaters', 'public');

            // Update user with avater path
            $user->update([
                'avater_image' => $path,
            ]);
        }

        return to_route('profile', ['user'=>$user])->with('success', 'Avater updated successfully.');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
