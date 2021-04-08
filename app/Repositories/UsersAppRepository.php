<?php

namespace App\Repositories;

use App\Models\UsersApp;
use App\Repositories\BaseRepository;

/**
 * Class UsersAppRepository
 * @package App\Repositories
 * @version November 18, 2019, 2:32 pm UTC
*/

class UsersAppRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_tp_sexo',
        'id_country',
        'id_departament',
        'id_city',
        'id_distrito',
        'nombres',
        'apellidos',
        'f_nacimiento',
        'usuario',
        'telefono',
        'email',
        'id_status_users_app'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UsersApp::class;
    }

    public function with($relations) {
       if (is_string($relations)) $relations = func_get_args();

       $this->with = $relations;

       return $this;
   }
}
