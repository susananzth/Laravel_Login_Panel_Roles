<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CityRequest extends FormRequest
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
    public static function rules($stateId = null, $cityId = null): array
    {
        $baseRules = [
            'name'     => ['required', 'string', 'max:150'],
            'state_id' => ['required', 'integer', 'exists:states,id'],
        ];

        if ($stateId) {
            if ($cityId) {
                $baseRules['name'][] = Rule::unique('cities', 'name')->where('state_id', $stateId)->ignore($cityId);
            } else {
                $baseRules['name'][] = Rule::unique('cities', 'name')->where('state_id', $stateId);
            }
        }

        return $baseRules;
    }
}