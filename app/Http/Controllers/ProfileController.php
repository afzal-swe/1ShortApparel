<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{



    /**
     * Display the profile edit form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Request $request): View
    {
        // Returns the profile edit view with the currently authenticated user.
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }



    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Fill the authenticated user's profile with validated data from the request.
        $request->user()->fill($request->validated());

        // If the email has been modified, reset the email verification timestamp.
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Save the updated user profile to the database.
        $request->user()->save();

        // Redirect back to the profile edit page with a success status message.
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }





    /**
     * Delete the authenticated user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validate the user's password for account deletion with a custom error bag.
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        // Retrieve the authenticated user.
        $user = $request->user();

        // Log out the authenticated user.
        Auth::logout();

        // Delete the authenticated user's account.
        $user->delete();

        // Invalidate the session to ensure it is terminated.
        $request->session()->invalidate();

        // Regenerate the session token to prevent session fixation attacks.
        $request->session()->regenerateToken();

        // Redirect to the homepage after account deletion.
        return Redirect::to('/');
    }
}
