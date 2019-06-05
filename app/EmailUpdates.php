<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailUpdates extends Model
{
    protected $table = "emailupdates";
    protected $primaryKey = "idEmailUpdate";
    public $timestamps = false;

    public function user(){
        return $this->hasOne('App\User','idUser','idUser');
    }
}
