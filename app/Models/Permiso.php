<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Permiso;

/**
 * Class Permiso
 * @package App\Models
 * @version December 2, 2019, 3:45 pm UTC
 *
 * @property string permiso
 * @property boolean status_system
 * @property boolean status_user
 * @property integer modified_by
 */
class Permiso extends Model
{
    use SoftDeletes;

    public    $table = 'permisos';

    protected $dates = ['deleted_at'];



    public $fillable = [
        'permiso',
        'status_system',
        'status_user',
        'modified_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'            => 'integer',
        'permiso'       => 'string',
        'status_system' => 'boolean',
        'status_user'   => 'boolean',
        'modified_by'   => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
      'permiso'     => 'required',
      'modified_by' => 'required'

    ];
    public function getPermisos()
    {
      return $this->belongsTo(Permiso::class, 'id_permisos');
    }
}
