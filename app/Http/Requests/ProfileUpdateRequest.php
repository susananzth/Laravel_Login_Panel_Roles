<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name'       => ['required', 'string', 'max:150'],
            'last_name'        => ['required', 'string', 'max:150'],
            'image'            => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:3000'],
            'document_type_id' => ['required', 'integer', 'exists:document_types,id'],
            'document_number'  => ['required', 'string', 'max:50'],
            'phone_code_id'    => ['required', 'integer', 'exists:countries,id'],
            'phone'            => ['required', 'string', 'max:50'],
            'email'            => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }
}
