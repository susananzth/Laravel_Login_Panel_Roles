<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('role_add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public static function rules($roleId = null): array
    {
        $baseRules = [
            'title' => ['required', 'string', 'max:255'],
        ];

        if ($roleId) {
            $baseRules['title'][] = 'unique:roles,title,' . $roleId;
        } else {
            $baseRules['title'][] = 'unique:roles,title';
        }

        return $baseRules;
    }
}
