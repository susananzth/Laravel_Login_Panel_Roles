<?php

namespace App\Repositories;

use App\Models\Permiso;
use App\Repositories\BaseRepository;

/**
 * Class PermisoRepository
 * @package App\Repositories
 * @version December 2, 2019, 3:45 pm UTC
*/

class PermisoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'permiso',
        'status_system',
        'status_user',
        'modified_by'
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
        return Permiso::class;
    }
}
