<?php

namespace App\Repositories;

use App\Models\TpRol;
use App\Repositories\BaseRepository;

/**
 * Class TpRolRepository
 * @package App\Repositories
 * @version November 12, 2019, 3:32 pm UTC
*/

class TpRolRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descripcion',
        'status'
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
        return TpRol::class;
    }
}
