<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProduktyGlownaController extends Controller
{
    public function index()
    {

        return view('products.productsGlowna');
    }
}
