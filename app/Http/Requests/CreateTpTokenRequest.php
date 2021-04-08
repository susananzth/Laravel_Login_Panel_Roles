<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\TpToken;

class CreateTpTokenRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return TpToken::$rules;
    }

    public function attributes()
      {
        return [
          'descripcion' => '"Descripción del tipo de token"',
          'status'      => '"Estado del tipo de token"'

          ];
      }

}
