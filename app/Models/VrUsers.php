<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class VrUsers extends Authenticatable
{

    use Notifiable;

    use SoftDeletes;

    public $incrementing = false;
    /**
     * $table name DataBases
     */
    protected $table = 'vr_users';

    /**
     * $fillable is table 'vr_users' fields
     */

    protected $fillable = ['id', 'name', 'email', 'password', 'phone'];

    /**
     * $hidden is table 'vr_users' fields is hidden
     */

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->belongsToMany(VrRoles::class, 'vr_connections_users_roles', 'user_id', 'role_id' );
    }

    public function orders()
    {
        return$this->hasMany(VrOrder::class, 'user_id', 'id')->with(['experiences']);
    }
    public function getTableName()
    {
        $tableName = substr($this->table,3);
        return $tableName;
    }


}
