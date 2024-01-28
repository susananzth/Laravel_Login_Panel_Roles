<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public static function rules($stateId = null): array
    {
        $baseRules = [
            'name'       => ['required', 'string', 'max:200'],
            'iso_2'      => ['nullable', 'string', 'max:2'],
            'country_id' => ['required', 'integer', 'exists:countries,id'],
        ];

        if ($stateId) {
            $baseRules['name'][] = 'unique:states,name,' . $stateId . ',country_id';
            $baseRules['iso_2'][] = 'unique:states,iso_2,' . $stateId;
        } else {
            $baseRules['name'][] = Rule::unique('states', 'name')->where('country_id', request('country_id'));
            $baseRules['iso_2'][] = 'unique:states,iso_2';
        }

        return $baseRules;
    }
}