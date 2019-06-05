<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordUpdates extends Model
{
    protected $table = "passwordupdates";
    protected $primaryKey = "idPasswordUpdate";
    public $timestamps = false;

    public function user(){
        return $this->hasOne('App\User','idUser','idUser');
    }
}
