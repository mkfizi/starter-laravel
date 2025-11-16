<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\PasswordUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display the account settings.
     */
    public function account(Request $request): View
    {
        return view('dashboard.settings.partials.account', [
            'user' => $request->user(),
        ]);
    }
    /**
     * Display the password settings.
     */
    public function password(Request $request): View
    {
        return view('dashboard.settings.partials.password', [
            'user' => $request->user(),
        ]);
    }
    
    /**
     * Display the two-factor authentication settings.
     */
    public function twoFactor(Request $request): View
    {
        return view('dashboard.settings.partials.two-factor', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information (email, name, etc).
     */
    public function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('dashboard.settings.account')->with('status', __('Profile updated successfully.'));
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(PasswordUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->password = Hash::make($request->validated()['password']);
        $user->save();

        return Redirect::route('dashboard.settings.password')->with('status', __('Password updated successfully.'));
    }
    
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/login');
    }
}
