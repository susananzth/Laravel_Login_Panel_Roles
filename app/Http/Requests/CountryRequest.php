<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
    public static function rules($countryId = null): array
    {
        $baseRules = [
            'name'       => ['required', 'string', 'max:200'],
            'iso_2'      => ['nullable', 'string', 'max:2'],
            'iso_3'      => ['nullable', 'string', 'max:3'],
            'iso_number' => ['nullable', 'integer'],
            'phone_code' => ['required', 'integer'],
        ];

        if ($countryId) {
            $baseRules['name'][] = 'unique:countries,name,' . $countryId;
            $baseRules['iso_2'][] = 'unique:countries,iso_2,' . $countryId;
            $baseRules['iso_3'][] = 'unique:countries,iso_3,' . $countryId;
            $baseRules['iso_number'][] = 'unique:countries,iso_number,' . $countryId;
            $baseRules['phone_code'][] = 'unique:countries,phone_code,' . $countryId;
        } else {
            $baseRules['name'][] = 'unique:countries,name';
            $baseRules['iso_2'][] = 'unique:countries,iso_2';
            $baseRules['iso_3'][] = 'unique:countries,iso_3';
            $baseRules['iso_number'][] = 'unique:countries,iso_number';
            $baseRules['phone_code'][] = 'unique:countries,phone_code';
        }

        return $baseRules;
    }
}