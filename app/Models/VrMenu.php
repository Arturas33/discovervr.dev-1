<?php

namespace App\Models;



class VrMenu extends CoreModel
{

    /**
     * Database table name
     * @var string
     */
    protected $table = 'vr_menu';
    /**
     * Fillable column names
     * @var array
     */
    protected $fillable = ['id', 'url', 'new_window', 'name', 'sequence', 'vr_parent_id'];



    public function subCategory()
    {
        return $this->hasMany(VrMenu::class, 'vr_parent_id');
    }


    public function translation()
    {
        return $this->belongsToMany(VrLanguageCodes::class, 'vr_menu_translations', 'menu_id', 'language_code' )->withPivot('name');
    }
}
