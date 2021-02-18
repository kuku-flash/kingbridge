<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car_make extends Model
{
    use HasFactory;
    public function car_model () {
        return $this->hasMany('App\Car_model');
    }

    public function car_ad (){
        return $this->hasMany('App\Car_ad');
    }
}
