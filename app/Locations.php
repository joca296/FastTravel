<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    protected $table = "locations";
    protected $primaryKey = "idLocation";
    public $timestamps = false;

    public function country(){
        return $this->hasOne("App\Countries","idCountry","idCountry");
    }
}
