<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Permiso;

class UpdatePermisoRequest extends FormRequest
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
        $rules = Permiso::$rules;

        return $rules;
    }
    public function attributes()
    {
      return [
        'permiso'     => 'Permisos',
        'modified_by' => 'Modificado por'

        ];
    }
}
