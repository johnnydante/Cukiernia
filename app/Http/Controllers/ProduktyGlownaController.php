<?php

namespace App\Http\Controllers;


class ProduktyGlownaController extends Controller
{
    public function index()
    {
        return view('products.productsGlowna');
    }
}
