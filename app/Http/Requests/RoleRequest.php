<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
    public static function rules($roleId = null): array
    {
        $baseRules = [
            'title' => ['required', 'string', 'max:150'],
            'status' => ['nullable']
        ];

        if ($roleId) {
            $baseRules['title'][] = 'unique:roles,title,' . $roleId;
            $baseRules['status'][] = ['required', 'boolean'];
        } else {
            $baseRules['title'][] = 'unique:roles,title';
        }

        return $baseRules;
    }
}