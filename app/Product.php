<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nazwa', 'cena','description','filename', 'rodzaj', 'cena_mala'
    ];

}
