<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NavMenus extends Model
{
    protected $table = 'nav_menus';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
