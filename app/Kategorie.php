<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategorie extends Model
{
    protected $fillable = [
        'nazwa', 'opis', 'filename'
    ];
}
