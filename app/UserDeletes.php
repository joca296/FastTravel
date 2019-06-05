<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDeletes extends Model
{
    protected $table = "userdeletes";
    protected $primaryKey = "idUserDelete";
    public $timestamps = false;
}
