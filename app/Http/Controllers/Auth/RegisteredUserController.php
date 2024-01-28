<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name'       => ['required', 'string', 'max:150'],
            'last_name'        => ['required', 'string', 'max:150'],
            'document_type_id' => ['required', 'integer', 'exists:document_types,id'],
            'document_number'  => ['required', 'string', 'max:50'],
            'city_id'          => ['required', 'integer', 'exists:cities,id'],
            'address'          => ['required', 'string', 'max:255'],
            'phone_code_id'    => ['required', 'integer', 'exists:countries,id'],
            'phone'            => ['required', 'string', 'max:50'],
            'email'            => ['required', 'string', 'email', 'max:255'],
            'password'         => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'first_name'       => Str::title($request->first_name),
            'last_name'        => Str::title($request->last_name),
            'document_type_id' => $request->document_type_id,
            'document_number'  => $request->document_number,
            'city_id'          => $request->city_id,
            'address'          => $request->address,
            'phone_code_id'    => $request->phone_code_id,
            'phone'            => $request->phone,
            'email'            => Str::lower($request->email),
            'password'         => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}