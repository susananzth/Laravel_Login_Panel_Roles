<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Repositories\BaseRepository;

/**
 * Class MenuRepository
 * @package App\Repositories
 * @version December 2, 2019, 3:34 pm UTC
*/

class MenuRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'menu',
        'section',
        'path',
        'icon',
        'note',
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
        return Menu::class;
    }


}
