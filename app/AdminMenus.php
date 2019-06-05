<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminMenus extends Model
{
    protected $table = "adminmenu";
    protected $primaryKey = "idMenu";
    public $timestamps = false;
}
