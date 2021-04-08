<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\TokenUsersApp;

class UpdateTokenUsersAppRequest extends FormRequest
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
        $rules = TokenUsersApp::$rules;

        return $rules;
    }

    public function attributes()
        {
          return [
            'id_tp_token' => '"Nuevo Token de usuario"',
            'token_llave' => '"Llave del token de usuario"',
            'token_code'  => '"Código del token de usuario"',
            'status'      => '"Estado del token"'
          ];
        }

}
