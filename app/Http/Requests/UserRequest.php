<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('user_add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public static function rules($userId = null): array
    {
        $baseRules = [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255'],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ];

        if ($userId) {
            $baseRules['email'][] = 'unique:users,email,' . $userId;
        } else {
            $baseRules['email'][] = 'unique:users,email';
        }

        return $baseRules;
    }
}
