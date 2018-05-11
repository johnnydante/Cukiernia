<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wesele extends Model
{
    protected $fillable = [
        'termin', 'users_id', 'termin', 'na_ile_osob_tort', 'rodzaj_tortu', 'smak', 'filename', 'status', 'wielkosc_paczki', 'ile_paczek', 'sernik', 'smietana_galaertka', 'jablecznik', 'makowiec', 'owocowe', 'rafaello', 'w_z', 'miodownik', 'czekoladowe', 'info', 'cena', 'rodzaj_masy', 'seromak', 'pani_walewska', 'ambasador', 'brzoskwiniowiec', 'pianka_z_malinami', 'królewiec', 'szpinakowe', 'powidła_krem', 'rureczki', 'babeczki', 'ciasteczka_mieszane'
    ];

    public function getUser(){
        return $this->hasOne('App\User', 'id', 'users_id')->first();
    }
}
