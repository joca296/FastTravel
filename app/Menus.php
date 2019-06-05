<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $table = "menu";
    protected $primaryKey = "idMenu";
    public $timestamps = false;
}
