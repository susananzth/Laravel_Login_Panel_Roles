<?php

namespace App\Repositories;

use App\Models\TokenUsersApp;
use App\Repositories\BaseRepository;

/**
 * Class TokenUsersAppRepository
 * @package App\Repositories
 * @version November 28, 2019, 9:12 pm UTC
*/

class TokenUsersAppRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_tp_token',
        'token_llave',
        'token_code',
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
        return TokenUsersApp::class;
    }

    public function with($relations) {
       if (is_string($relations)) $relations = func_get_args();

       $this->with = $relations;

       return $this;
   }

}
