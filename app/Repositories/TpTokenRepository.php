<?php

namespace App\Repositories;

use App\Models\TpToken;
use App\Repositories\BaseRepository;

/**
 * Class TpTokenRepository
 * @package App\Repositories
 * @version November 28, 2019, 4:47 pm UTC
*/

class TpTokenRepository extends BaseRepository
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
        return TpToken::class;
    }
}
