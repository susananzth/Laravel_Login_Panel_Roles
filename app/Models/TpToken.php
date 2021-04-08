<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TpToken;

/**
 * Class TpToken
 * @package App\Models
 * @version November 28, 2019, 4:47 pm UTC
 *
 * @property string descripcion
 * @property boolean status
 */
class TpToken extends Model
{
    use SoftDeletes;

    public    $table = 'tp_tokens';

    protected $dates = ['deleted_at'];



    public $fillable = [
        'descripcion',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'descripcion' => 'string',
        'status'      => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descripcion' => 'required|string|max:100|min:4',
        'status'      => 'required'

    ];
    public function getTpToken()
        {
          return $this->belongsTo(TpToken::class, 'id_tp_tokens');
        }
}
