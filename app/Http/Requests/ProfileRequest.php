<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public static function rules($userId = null, $update_passowrd = null): array
    {
        $baseRules = [];

        if ($update_passowrd) {
            $baseRules = [
                'password' => ['required', Password::defaults(), 'confirmed'],
                'current_password' => ['required', 'current_password'],
            ];
        } else {
            $baseRules = [
                'first_name'       => ['required', 'string', 'max:150'],
                'last_name'        => ['required', 'string', 'max:150'],
                'image'            => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:3000'],
                'document_type_id' => ['required', 'integer', 'exists:document_types,id'],
                'document_number'  => ['required', 'string', 'max:50'],
                'city_id'          => ['required', 'integer', 'exists:cities,id'],
                'address'          => ['required', 'string', 'max:255'],
                'phone_code_id'    => ['required', 'integer', 'exists:countries,id'],
                'phone'            => ['required', 'string', 'max:50'],
                'email'            => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $userId],
            ];
        }

        return $baseRules;
    }
}