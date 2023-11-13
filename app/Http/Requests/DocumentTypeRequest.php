<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentTypeRequest extends FormRequest
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
    public static function rules($documentTypeId = null): array
    {
        $baseRules = [
            'name'   => ['required', 'string', 'max:100'],
            'status' => ['nullable']
        ];

        if ($documentTypeId) {
            $baseRules['name'][] = 'unique:document_types,name,' . $documentTypeId;
            $baseRules['status'][] = ['required', 'boolean'];
        } else {
            $baseRules['name'][] = 'unique:document_types,name';
        }

        return $baseRules;
    }
}