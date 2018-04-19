<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tort extends Model
{
    protected $fillable = [
        'users_id', 'id_kategorii', 'na_ile_osob', 'rodzaj_dekoracji', 'status', 'info', 'termin', 'filename', 'cena'
    ];

    public function getCategory(){
        return $this->hasOne('App\Kategorie', 'id', 'id_kategorii')->first();
    }

    public function getUser(){
        return $this->hasOne('App\User', 'id', 'users_id')->first();
    }
}
