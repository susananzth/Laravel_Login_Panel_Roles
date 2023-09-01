<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
    public static function rules($cityId = null): array
    {
        $baseRules = [
            'name'     => ['required', 'string', 'max:200'],
            'state_id' => ['required', 'integer', 'exists:states,id'],
        ];

        if ($cityId) {
            $baseRules['name'][] = 'unique:cities,name,' . $stateId . ',state_id';
        } else {
            $baseRules['name'][] = Rule::unique('cities', 'name')->where('state_id', request('state_id'));
        }

        return $baseRules;
    }
}
