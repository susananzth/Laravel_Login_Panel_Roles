<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\DocumentType;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $data['phone_codes'] = Country::orderBy('name', 'asc')->get();
        $data['documents']   = DocumentType::orderBy('name', 'asc')->get();
        $data['user']        = $request->user();
        return view('profile.edit', $data);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Convertir los campos antes de la validación
        $request->merge([
            'first_name' => Str::title($request->input('first_name')),
            'last_name' => Str::title($request->input('last_name')),
            'email' => Str::lower($request->input('email')),
        ]);

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')
            ->with('message', trans('message.Updated Successfully.', ['name' => __('Profile Information')]))
            ->with('alert_class', 'success');
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

        $user->roles()->detach();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
