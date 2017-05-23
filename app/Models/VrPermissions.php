<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VrPermissions extends Model
{
    use CoreTrait;
    /**
     * $table name DataBases
     */
    protected $table = 'vr_permissions';

    /**
     * $fillable is table 'vr_permissions' fields
     */

    protected $fillable = ['id', 'name'];
}
