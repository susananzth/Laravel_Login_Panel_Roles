<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
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
    public static function rules($currencyId = null): array
    {
        $baseRules = [
            'name'   => ['required', 'string', 'max:150'],
            'iso_4'  => ['required', 'string', 'max:5'],
            'symbol' => ['required', 'string', 'max:10'],
        ];

        if ($currencyId) {
            $baseRules['name'][] = 'unique:currencies,name,' . $currencyId;
        } else {
            $baseRules['name'][] = 'unique:currencies,name';
        }

        return $baseRules;
    }
}