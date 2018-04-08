<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'users_id', 'id_produktu', 'wielkosc', 'ilosc', 'status', 'info', 'termin',
    ];

    public function getProduct(){
        return $this->hasOne('App\Product', 'id', 'id_produktu')->first();
    }

    public function getUser(){
        return $this->hasOne('App\User', 'id', 'users_id')->first();
    }
}
