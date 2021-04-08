<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\RolMenu;

class UpdateRolMenuRequest extends FormRequest
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
        $rules = RolMenu::$rules;

        return $rules;
    }

    public function attributes()
  {
    return [
        'id_rol'      => 'Rol',
        'id_menu'     => 'Menú',
        'note'        => 'Nota',
        'modified_by' => 'Modificado por'

      ];
  }
}
