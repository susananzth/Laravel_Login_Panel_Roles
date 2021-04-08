<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TpToken;
use App\Models\TokenUsersApp;

/**
 * Class TokenUsersApp
 * @package App\Models
 * @version November 28, 2019, 9:12 pm UTC
 *
 * @property integer id_tp_token
 * @property string token_llave
 * @property string token_code
 * @property boolean status
 */
class TokenUsersApp extends Model
{
    use SoftDeletes;

    public    $table = 'token_users_apps';

    protected $dates = ['deleted_at'];



    public $fillable = [
        'id_tp_token',
        'token_llave',
        'token_code',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'id_tp_token' => 'integer',
        'token_llave' => 'string',
        'token_code'  => 'string',
        'status'      => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_tp_token' => 'required',
        'token_llave' => 'required|email',
        'token_code'  => 'required|string',
        'status'      => 'required'
    ];

    public function getTpToken()
        {
          return $this->belongsTo(tpToken::class, 'id_tp_token');
        }
    public function getTokenUsersApp()
        {
          return $this->belongsTo(TokenUsersApp::class, 'id_token_users_apps');
        }
}
