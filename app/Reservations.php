<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    protected $table = "reservations";
    protected $primaryKey = "idReservation";
    public $timestamps = false;

    public function offer(){
        return $this->hasOne('App\Offers','idOffer','idOffer');
    }

    public function user(){
        return $this->hasOne('App\User','idUser','idUser');
    }
}
