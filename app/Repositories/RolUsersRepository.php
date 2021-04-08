<?php

namespace App\Repositories;

use App\Models\RolUsers;
use App\Repositories\BaseRepository;

/**
 * Class RolUsersRepository
 * @package App\Repositories
 * @version November 20, 2019, 7:57 pm UTC
*/

class RolUsersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
      'id_user',
      'id_tp_rol',
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
        return RolUsers::class;
    }
    public function with($relations) {
       if (is_string($relations)) $relations = func_get_args();

       $this->with = $relations;

       return $this;
   }

}
